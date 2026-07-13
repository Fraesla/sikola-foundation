<?php

namespace App\Services;

use App\Models\User;
use App\Models\RiwayatPoin;
use App\Models\Donasi;
use App\Models\RiwayatLanggananPembayaran;
use App\KategoriPoin;
use Illuminate\Database\Eloquent\Model;

class PoinService
{
    public function __construct(protected TierService $tierService){

    }

    public function tambahPoin(
        User $user,
        int $poin,
        KategoriPoin $kategori,
        ?Model $referensi = null,
        ?string $keterangan = null
    ): void
    {
        $user->increment('total_poin', $poin);

        RiwayatPoin::create([

            'user_id' => $user->id,
            'tipe' => 'masuk',
            'poin' => $poin,
            'kategori' => $kategori,

            'referensi_type' => $referensi
                ? get_class($referensi)
                : null,

            'referensi_id' => $referensi?->id,

            'keterangan' => $keterangan,

        ]);

        $user->refresh();

        $this->tierService->hitungDanPerbaruiTier($user);
    }
    public function kurangiPoin(User $user,int $poin,string $kategori,?Model $referensi = null,?string $keterangan = null): void
    {

        $user->decrement('total_poin',$poin);

        RiwayatPoin::create([

            'user_id'=>$user->id,
            'tipe'=>'keluar',
            'poin'=>$poin,
            'kategori'=>$kategori,

            'referensi_tipe'=>$referensi
                ? get_class($referensi)
                : null,

            'referensi_id'=>$referensi?->id,
            'keterangan'=>$keterangan,

        ]);

        $user->refresh();

        $this->tierService->hitungDanPerbaruiTier($user);

    }
    public function hitungPoin(int $nominal, string $jenis): int
    {
        $config = config("poin.$jenis");

        if (!$config || empty($config['rupiah_per_poin'])) {
            return 0;
        }

        $poin = floor($nominal / $config['rupiah_per_poin']);

        if (isset($config['bonus'])) {
            $poin += $config['bonus'];
        }

        return $poin;
    }
    public function hitungPoinDonasi(Donasi $donasi): int
    {
        return $this->hitungPoin(
            $donasi->jumlah,
            $donasi->tipe == 'bulanan'
                ? 'donasi_bulanan'
                : 'donasi_sekali'
        );
    }
    public function hitungPoinLangganan(RiwayatLanggananPembayaran $riwayat): int
    {
        return $this->hitungPoin(
            $riwayat->jumlah,
            'donasi_bulanan'
        );
    }
    /**
     * Tambah poin user.
     */
    public function tambah(User $user, int $poin): void
    {
        if ($poin <= 0) {
            return;
        }

        $user->increment('total_poin', $poin);

        $user->refresh();

        app(TierService::class)
            ->recalculate($user);
    }

    /**
     * Kurangi poin user.
     */
    public function kurangi(User $user, int $poin): void
    {
        if ($poin <= 0) {
            return;
        }

        $total = max(
            0,
            $user->total_poin - $poin
        );

        $user->update([
            'total_poin' => $total
        ]);

        $user->refresh();

        app(TierService::class)
            ->recalculate($user);
    }

    /**
     * Set poin user.
     */
    public function set(User $user, int $poin): void
    {
        $user->update([
            'total_poin' => max(0, $poin)
        ]);

        $user->refresh();

        app(TierService::class)
            ->recalculate($user);
    }

    /**
     * Reset poin.
     */
    public function reset(User $user): void
    {
        $user->update([
            'total_poin' => 0
        ]);

        $user->refresh();

        app(TierService::class)
            ->recalculate($user);
    }

    /**
     * Recalculate tier saja.
     */
    public function refreshTier(User $user): void
    {
        app(TierService::class)
            ->recalculate($user);
    }
}