<?php

namespace App\Services;

use App\KategoriPoin;
use App\Models\Absensi;
use App\Models\AbsensiDetail;
use App\Models\Event;
use App\Models\Peserta;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventAttendanceService
{
    protected PoinService $poinService;

    public function __construct(PoinService $poinService)
    {
        $this->poinService = $poinService;
    }

    public function finalisasi(Event $event): void
    {
        DB::transaction(function () use ($event) {

            $pesertas = Peserta::where('event_id', $event->id)->get();

            foreach ($pesertas as $peserta) {

                $this->generateKelulusan(
                    $event,
                    $peserta
                );

            }

        });
    }
    /**
     * ===========================================================
     * Generate Kelulusan Peserta
     * ===========================================================
     */
    protected function generateKelulusan(
        Event $event,
        Peserta $peserta
    ): void
    {
        $minimalKelulusan = 75;
        $persentase = (float) $peserta->persentase_kehadiran;

        $status = $persentase >= $minimalKelulusan
            ? 'lulus'
            : 'tidak_lulus';

        $reward = $status == 'lulus'
            ? $event->poin_reward
            : ($event->poin_penalty ?? 0); // Pastikan poin penalty ada, jika tidak default ke 0

        // 1. AMBIL POIN LAMA SEBELUM DATA DI-UPDATE
        $poinLama = $event->poin_penalty;

        // 2. JALANKAN UPDATE POIN USER TERLEBIH DAHULU (Sebelum $peserta->poin berubah)
        $this->updateUserPoint(
            $event,
            $peserta,
            $status,
            $reward,
            $poinLama
        );

        // 3. UPDATE DATA PESERTA SETELAHNYA
        $peserta->update([
            'status' => $status,
            'poin' => $reward,
            'lulus_pada' => $status == 'lulus' ? now() : null,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Generate Sertifikat
        |--------------------------------------------------------------------------
        */
        if ($status == 'lulus') {
            $peserta->load('user');
            $this->generateCertificate(
                $event,
                $peserta
            );
        }
    }

    /**
     * ===========================================================
     * Update Poin User
     * ===========================================================
     */
    private function updateUserPoint(
        Event $event,
        Peserta $peserta,
        string $status,
        int $reward,
        int $poinLama
    ): void {
        $user = User::find($peserta->user_id);

        if (!$user) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Peserta Lulus
        |--------------------------------------------------------------------------
        */
        if ($status === 'lulus') {
            // Berikan poin jika sebelumnya belum diberikan dan reward > 0
            if (!$peserta->poin_berikan && $reward > 0) {
                $this->poinService->tambahPoin(
                    $user,
                    $reward,
                    KategoriPoin::EVENT,
                    $peserta,
                    "Reward Event {$event->judul}"
                );

                $peserta->update([
                    'poin_berikan' => true,
                ]);
            }
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Peserta Tidak Lulus
        |--------------------------------------------------------------------------
        */
        if ($status === 'tidak_lulus') {
            // Jika sebelumnya pernah diberi poin (poinLama > 0), tarik/kurangi poin tersebut
            if ($poinLama > 0) {
                $this->poinService->kurangiPoin(
                    $user,
                    $poinLama, // Mengurangi berdasarkan poin dari tabel peserta sebelumnya
                    'event',
                    $peserta,
                    "Penyesuaian: Peserta tidak lulus Event {$event->judul}"
                );
            }

            // Set status poin_berikan menjadi false karena sudah dikurangi/tidak dapat reward
            $peserta->update([
                'poin_berikan' => false,
            ]);
        }
    }

    /**
     * ===========================================================
     * Generate Sertifikat Peserta
     * ===========================================================
     */
    private function generateCertificate(
        Event $event,
        Peserta $peserta
    ): void {

        /*
        |--------------------------------------------------------------------------
        | Jangan Generate Dua Kali
        |--------------------------------------------------------------------------
        */

        if (!empty($peserta->sertifikat)) {
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Nomor Sertifikat
        |--------------------------------------------------------------------------
        */

        $nomor = sprintf(
            'SKL/%s/%04d/%04d',
            now()->year,
            $event->id,
            $peserta->id
        );

        /*
        |--------------------------------------------------------------------------
        | Simpan dulu nomor sertifikat
        |--------------------------------------------------------------------------
        */

        $peserta->update([
            'nomor_sertifikat' => $nomor,

            'sertifikat_diterbitkan' => now(),
        ]);

        /*
        |--------------------------------------------------------------------------
        | Render Blade menjadi PDF
        |--------------------------------------------------------------------------
        */

        $pdf = Pdf::setOptions([
            'dpi' => 150,
            'defaultFont' => 'DejaVu Sans',
            'isRemoteEnabled' => true,
            'isPhpEnabled' => true,
        ])
        ->loadView(
            'sertifikat.template',
            compact('event', 'peserta')
        )
        ->setPaper('a4', 'landscape');

        /*
        |--------------------------------------------------------------------------
        | Folder
        |--------------------------------------------------------------------------
        */

        $folder = 'sertifikat/event';

        Storage::disk('public')->makeDirectory($folder);

        /*
        |--------------------------------------------------------------------------
        | Nama File
        |--------------------------------------------------------------------------
        */

        $filename = sprintf(
            '%s/event_%d_peserta_%d.pdf',
            $folder,
            $event->id,
            $peserta->id
        );

        /*
        |--------------------------------------------------------------------------
        | Simpan PDF
        |--------------------------------------------------------------------------
        */

        Storage::disk('public')->put(
            $filename,
            $pdf->output()
        );

        /*
        |--------------------------------------------------------------------------
        | Update Peserta
        |--------------------------------------------------------------------------
        */

        $peserta->update([

            'sertifikat' => $filename,

        ]);

    } 
}
