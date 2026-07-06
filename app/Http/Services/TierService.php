<?php

namespace App\Services;

use App\Models\Tier;

class TierService
{
    public function tambahPoin(User $user, int $poin): void
    {
        $user->increment('total_poin', $poin);
        $user->refresh();
        $this->hitungDanPerbaruiTier($user);
    }

    public function hitungDanPerbaruiTier(User $user): void
    {
        $tier = Tier::where('min_poin', '<=', $user->total_poin)
            ->where(function ($q) use ($user) {
                $q->whereNull('max_poin')
                  ->orWhere('max_poin', '>=', $user->total_poin);
            })
            ->orderByDesc('min_poin')
            ->first();

        if ($tier && $user->tier_id !== $tier->id) {
            $oldTier = $user->tier;
            $user->update(['tier_id' => $tier->id]);
            app(NotifikasiService::class)->tierNaik($user, $oldTier, $tier);
        }
    }
    public function recalculate(User $user)
    {
        if ($user->poin >= 1000) {
            $user->tier = 'Platinum';
        } elseif ($user->poin >= 500) {
            $user->tier = 'Gold';
        } elseif ($user->poin >= 100) {
            $user->tier = 'Silver';
        } else {
            $user->tier = 'Bronze';
        }

        $user->save();
    }
}