<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Donasi;
use Carbon\Carbon;
use App\Models\RiwayatLanggananPembayaran;
use Illuminate\Support\Str;

class DonationCategory extends Model
{
    protected $table = 'donasi_kategori';
    
    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'icon',
        'gambar',
        'minimal_donasi',
        'maksimal_donasi',
        'target_default',
        'lokasi',
        'is_aktif',
        'created_by'
    ];
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {

            if (empty($item->slug)) {
                $item->slug = Str::slug($item->nama);
            }
        });
    }
    public function donasis()
    {
        return $this->hasMany(
            Donasi::class,
            'donation_category_id'
        );
    }
    public function totalDonasiSekali()
    {
        return $this->donasis()
            ->where('tipe', 'sekali')
            ->where('status', 'dikonfirmasi')
            ->sum('jumlah');
    }


    public function totalDonasiBulanan()
    {
        return RiwayatLanggananPembayaran::whereHas(
            'donasi',
            function ($q) {

                $q->where(
                    'donation_category_id',
                    $this->id
                );

            }
        )
        ->where('status', 'dikonfirmasi')
        ->sum('jumlah');
    }

    public function danaTerkumpul()
    {
        return
            $this->totalDonasiSekali()
            +
            $this->totalDonasiBulanan();
    }

    public function jumlahDonatur()
    {
        return $this->donasis()
            ->where('status', 'dikonfirmasi')
            ->count();
    }

    public function donaturTerbaru($limit = 10)
    {
        $sekali = Donasi::with('user')
            ->where('donation_category_id', $this->id)
            ->where('tipe', 'sekali')
            ->where('status', 'dikonfirmasi')
            ->get()
            ->map(function ($item) {

                return (object)[

                    'nama' => $item->user->name ?? 'Hamba Allah',

                    'jumlah' => $item->jumlah,

                    'tipe' => 'sekali',

                    'created_at' => Carbon::parse(
                        $item->updated_at
                    ),

                ];

            });

        $bulanan = RiwayatLanggananPembayaran::with(
                'donasi.user'
            )
            ->whereHas(
                'donasi',
                function ($q) {

                    $q->where(
                        'donation_category_id',
                        $this->id
                    );

                }
            )
            ->where('status', 'dikonfirmasi')
            ->get()
            ->map(function ($item) {

                return (object)[

                    'nama' => optional(
                        $item->donasi->user
                    )->name ?? 'Hamba Allah',

                    'jumlah' => $item->jumlah,

                    'tipe' => 'bulanan',

                    'created_at' => Carbon::parse(
                        $item->dikonfirmasi_at
                        ??
                        $item->updated_at
                    ),

                ];

            });

        return $sekali
            ->concat($bulanan)
            ->sortByDesc('created_at')
            ->take($limit)
            ->values();
    }
}
