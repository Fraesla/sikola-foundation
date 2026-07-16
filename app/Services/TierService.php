<?php

namespace App\Services;

use App\Models\User;
use App\Models\Tier;

class TierService
{
    /**
     * Tambah poin user lalu cek tier.
     */
    public function tambahPoin(User $user, int $poin): void
    {
        $user->increment('total_poin', $poin);

        $user->refresh();

        $this->hitungDanPerbaruiTier($user);
    }

    /**
     * Kurangi poin user lalu cek tier.
     */
    public function kurangiPoin(User $user, int $poin): void
    {
        $user->decrement('total_poin', $poin);

        $user->refresh();

        $this->hitungDanPerbaruiTier($user);
    }

    /**
     * Hitung ulang tier berdasarkan total poin.
     */
    public function hitungDanPerbaruiTier(User $user): void
    {
        $tier = Tier::where('min_poin', '<=', $user->exp)
            ->where(function ($query) use ($user) {

                $query->whereNull('max_poin')
                    ->orWhere('max_poin', '>=', $user->exp);

            })
            ->orderByDesc('min_poin')
            ->first();

        if (!$tier) {
            return;
        }

        if ($user->tier_id != $tier->id) {

            $tierLama = $user->tier;

            $user->update([
                'tier_id' => $tier->id
            ]);

            // kirim notifikasi jika service tersedia
            if (class_exists(NotifikasiService::class)) {

                app(NotifikasiService::class)
                    ->tierNaik($user, $tierLama, $tier);

            }
        }
    }

    /**
     * Recalculate semua tier berdasarkan poin.
     */
    public function recalculate(User $user): void
    {
        $tier = Tier::where('min_poin', '<=', $user->total_poin)
            ->where(function ($q) use ($user) {

                $q->whereNull('max_poin')
                  ->orWhere('max_poin', '>=', $user->total_poin);

            })
            ->orderByDesc('min_poin')
            ->first();

        if (!$tier) {
            return;
        }

        if ($user->tier_id != $tier->id) {

            $tierLama = $user->tier;

            $user->update([
                'tier_id' => $tier->id
            ]);

            if (class_exists(NotifikasiService::class)) {

                app(NotifikasiService::class)
                    ->tierNaik($user, $tierLama, $tier);

            }
        }
    }
}