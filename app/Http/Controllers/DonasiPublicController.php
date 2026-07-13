<?php

namespace App\Http\Controllers;

use App\Models\Donasi;
use App\Models\DonationCategory;
use App\Models\DonasiLangganan;
use App\Models\RiwayatLanggananPembayaran;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DonasiPublicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private function roleView($view)
    {
        $role = auth()->user()->role;

        return match ($role) {
            'relawan' => "relawan.$view",
            default   => "donatur.$view",
        };
    }

    private function roleRoute($route)
    {
        $role = auth()->user()->role;

        return match($role){
            'relawan' => "relawan.$route",
            default   => "donatur.$route",
        };
    }
    public function index(Request $request)
    {
        $query = Donasi::with('kategori')
                    ->where('user_id', auth()->id());

        // SEARCH
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                // cari ID donasi
                $q->where('id', 'like', "%{$search}%")

                // cari nama kategori
                ->orWhereHas('kategori', function ($k) use ($search) {

                    $k->where('nama', 'like', "%{$search}%");

                });
            });
        }

        // FILTER STATUS
        if ($request->filled('status')) {

            switch ($request->status) {

                case 'menunggu_pembayaran':

                    $query->where('status', 'menunggu')
                          ->whereNull('bukti_transfer');

                break;

                case 'menunggu_verifikasi':

                    $query->where('status', 'menunggu')
                          ->whereNotNull('bukti_transfer');

                break;

                case 'berhasil':

                    $query->where('status', 'dikonfirmasi');

                break;

                case 'ditolak':

                    $query->where('status', 'ditolak');

                break;
            }
        }

        $donasis = Donasi::with('kategori')->where('user_id', auth()->id())->latest()->paginate(5);

        return view(
            $this->roleView('donasi'),
            compact('donasis')
        );
    }
    public function create()
    {
       return redirect()->route('donasi');
    }
    public function show($id)
    {
        $donasi = Donasi::with('kategori')->where('user_id', auth()->id())->findOrFail($id);

        return view(
            $this->roleView('donasi-detail'),
            compact('donasi')
        );
    }
    public function detail($id)
    {
        $donasi = Donasi::with('kategori')->where('user_id', auth()->id())->findOrFail($id);

        return view(
            $this->roleView('donasi-detail-langganan'),
            compact('donasi')
        );
    }
    public function store(Request $request)
    {
        $request->validate([
            'jumlah' => 'required|numeric',
            'donation_category_id' => 'required|exists:donasi_kategori,id'
        ]);

        $kategori = DonationCategory::findOrFail($request->donation_category_id);

        $request->validate([
            'jumlah' => [
                'required',
                'numeric',
                'min:'.$kategori->minimal_donasi,
                'max:'.($kategori->maksimal_donasi ?: 999999999)
            ]
        ],[
            'jumlah.min' => 'Minimal donasi Rp '.number_format($kategori->minimal_donasi,0,',','.'),
            'jumlah.max' => 'Maksimal donasi Rp '.number_format($kategori->maksimal_donasi,0,',','.')
        ]);

        // cek minimal donasi
        if ($request->jumlah < $kategori->minimal_donasi) {

            return back()
                    ->withInput()
                    ->with(
                        'error',
                        'Minimal donasi Rp '.number_format(
                            $kategori->minimal_donasi,
                            0,
                            ',',
                            '.'
                        )
                    );
        }

        // cek maksimal donasi (jika diisi)
        if (
            $kategori->maksimal_donasi &&
            $request->jumlah > $kategori->maksimal_donasi
        ) {

            return back()
                    ->withInput()
                    ->with(
                        'error',
                        'Maksimal donasi Rp '.number_format(
                            $kategori->maksimal_donasi,
                            0,
                            ',',
                            '.'
                        )
                    );
        }

        $donasi = Donasi::create([
            'user_id' => auth()->id(),
            'donation_category_id' => $request->donation_category_id,
            'tipe' => 'sekali',
            'jumlah' => $request->jumlah,
            'pesan' => $request->pesan,
            'poin_diberikan' => $request->jumlah / 10000,
            'status' => 'menunggu'
        ]);

        return redirect()
                ->route($this->roleRoute('donasi.index'))
                ->with(
                    'success',
                    'Donasi berhasil dibuat.'
                );
    }
    public function storeBulanan(Request $request)
    {
        $request->validate([
            'donation_category_id' => 'required|exists:donasi_kategori,id',
            'jumlah' => 'required|numeric|min:10000',
            'pesan' => 'nullable|string'
        ]);

        // cek apakah user masih memiliki langganan aktif
        $cek = DonasiLangganan::where('user_id', auth()->id())
                ->where('donation_category_id', $request->donation_category_id)
                ->where('is_aktif', 1)
                ->first();

        if($cek)
        {
            return back()->with(
                'error',
                'Anda masih memiliki donasi bulanan yang aktif.'
            );
        }

        $kategori = DonationCategory::findOrFail( $request->donation_category_id);

        $request->validate([
            'jumlah' => [
                'required',
                'numeric',
                'min:'.$kategori->minimal_donasi,
                'max:'.($kategori->maksimal_donasi ?: 999999999)
            ]
        ],[
            'jumlah.min' => 'Minimal donasi Rp '.number_format($kategori->minimal_donasi,0,',','.'),
            'jumlah.max' => 'Maksimal donasi Rp '.number_format($kategori->maksimal_donasi,0,',','.')
        ]);

        if ($request->jumlah < $kategori->minimal_donasi) {

            return back()
                    ->withInput()
                    ->with(
                        'error',
                        'Minimal donasi Rp '.number_format(
                            $kategori->minimal_donasi,
                            0,
                            ',',
                            '.'
                        )
                    );
        }

        if ($kategori->maksimal_donasi && $request->jumlah > $kategori->maksimal_donasi) 
        {
            return back()
                    ->withInput()
                    ->with(
                        'error',
                        'Maksimal donasi Rp '.number_format(
                            $kategori->maksimal_donasi,
                            0,
                            ',',
                            '.'
                        )
                    );
        }

        DB::beginTransaction();

        try {

            // simpan data langganan
            $langganan = DonasiLangganan::create([
                'user_id'         => auth()->id(),
                'donation_category_id' => $request->donation_category_id,
                'jumlah_bulanan'  => $request->jumlah,
                'tanggal_mulai'   => now(),
                'tanggal_akhir'   => now()->addMonth(),
                'is_aktif'        => 1
            ]);

            // simpan donasi pertama
            Donasi::create([
                'user_id'                => auth()->id(),
                'donation_category_id'   => $request->donation_category_id,
                'langganan_id'           => $langganan->id,
                'tipe'                   => 'bulanan',
                'jumlah'                => $request->jumlah,
                'pesan'                  => $request->pesan,
                'poin_diberikan'         => 0,
                'status'                 => 'dikonfirmasi'
            ]);

            DB::commit();

            return redirect()
                    ->route($this->roleRoute('donasi.index'))
                    ->with(
                        'success',
                        'Donasi bulanan berhasil didaftarkan.'
                    );

        } catch (\Exception $e) {

            DB::rollback();

            return back()->with(
                'error',
                $e->getMessage()
            );
        }
    }

    public function langganan(Donasi $donasi)
    {
        abort_if(
            $donasi->user_id != auth()->id(),
            403
        );

        $donasi->load([
            'kategori',
            'langganan'
        ]);

        $langganan = $donasi->langganan;

        if (!$langganan) {
            abort(404,'Data langganan tidak ditemukan.');
        }

        $riwayat = RiwayatLanggananPembayaran::where(
            'langganan_id',
            $langganan->id
        )
        ->latest()
        ->get();

        return view(
             $this->roleView('donasi-langganan'),
            compact(
                'donasi',
                'langganan',
                'riwayat'
            )
        );
    }

    public function langgananStore(Request $request, Donasi $donasi)
    {
        abort_if($donasi->user_id != auth()->id(), 403);

        $langganan = $donasi->langganan;

        if (!$langganan) {
            abort(404, 'Data langganan tidak ditemukan.');
        }

        $kategori = $donasi->kategori;

        $request->validate([
            'jumlah' => [
                'required',
                'numeric',
                'min:'.$kategori->minimal_donasi,
                Rule::when(
                    $kategori->maksimal_donasi,
                    'max:'.$kategori->maksimal_donasi
                ),
            ],

            'bukti_transfer' => [
                'required',
                'image',
                'max:2048'
            ]
        ]);

        DB::transaction(function () use ($request, $langganan, $donasi) {

            $path = $request
                ->file('bukti_transfer')
                ->store('langganan', 'public');

            RiwayatLanggananPembayaran::create([

                'langganan_id'   => $langganan->id,

                'donasi_id'      => $donasi->id,

                // periode aktif langganan
                'periode'        => $langganan->tanggal_mulai,

                'jumlah'         => $request->jumlah,

                // dihitung saat admin konfirmasi
                'poin'           => 0,

                // bonus juga nanti
                'bonus'          => 0,

                'bukti_transfer' => $path,

                'status'         => 'menunggu',

                'alasan_tolak'   => null,

            ]);

        });

        return redirect()
            ->route($this->roleRoute('langganan.bulanan'), $donasi->id)
            ->with(
                'success',
                'Pembayaran berhasil dikirim dan menunggu konfirmasi admin.'
            );
    }

    public function bayar($id)
    {
        $donasi = Donasi::with('kategori')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        if($donasi->status != 'menunggu')
        {
            return back()
                ->with('error',
                    'Donasi ini tidak dapat dibayar.');
        }

        return view(
            $this->roleView('donasi-bayar'),
            compact('donasi')
        );
    }
    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_transfer' =>
                'required|image|mimes:jpg,jpeg,png|max:5120'
        ]);

        $donasi = Donasi::where(
                'user_id',
                auth()->id()
            )
            ->findOrFail($id);

        // tidak boleh upload dua kali
        if($donasi->bukti_transfer)
        {
            return back()->with(
                'error',
                'Bukti transfer sudah diupload.'
            );
        }

        $path = $request
            ->file('bukti_transfer')
            ->store(
                'donasi/bukti',
                'public'
            );

        $donasi->update([
            'bukti_transfer' => $path
        ]);

        return redirect()
            ->route(
                $this->roleRoute('donasi.show'),
                $donasi->id
            )
            ->with(
                'success',
                'Bukti transfer berhasil diupload. Silahkan tunggu verifikasi admin.'
            );
    }

    public function akhiriLangganan(Donasi $donasi)
    {
        abort_if(
            $donasi->user_id != auth()->id(),
            403
        );

        if ($donasi->tipe != 'bulanan' || !$donasi->langganan_id) {

            return back()->with(
                'error',
                'Donasi ini bukan langganan.'
            );

        }

        $langganan = $donasi->langganan;

        if (!$langganan) {

            return back()->with(
                'error',
                'Data langganan tidak ditemukan.'
            );

        }

        if (!$langganan->is_aktif) {

            return back()->with(
                'warning',
                'Langganan sudah dihentikan.'
            );

        }

        DB::transaction(function () use ($langganan) {

            $langganan->update([
                'is_aktif' => 0
            ]);

        });

        return back()->with(
            'success',
            'Langganan berhasil dihentikan.'
        );
    }

    public function aktifkanLangganan(Donasi $donasi)
    {
        abort_if(
            $donasi->user_id != auth()->id(),
            403
        );

        if ($donasi->tipe != 'bulanan' || !$donasi->langganan_id) {

            return back()->with(
                'error',
                'Donasi ini bukan langganan.'
            );

        }

        $langganan = $donasi->langganan;

        if (!$langganan) {

            return back()->with(
                'error',
                'Data langganan tidak ditemukan.'
            );

        }

        if ($langganan->is_aktif) {

            return back()->with(
                'warning',
                'Langganan sudah aktif.'
            );

        }

        $langganan->update([
            'is_aktif' => 1
        ]);

        return back()->with(
            'success',
            'Langganan berhasil diaktifkan kembali.'
        );
    }
}
