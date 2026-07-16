<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Reward;
use App\Models\User;
use App\Models\RewardVoucher;

class RewardVoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        $voucherRewards = Reward::where('kategori', 'voucher')->get();

        if ($users->isEmpty() || $voucherRewards->isEmpty()) {
            return;
        }

        foreach ($users as $user) {

            foreach ($voucherRewards as $reward) {

                RewardVoucher::updateOrCreate(

                    [
                        'user_id'   => $user->id,
                        'reward_id' => $reward->id,
                    ],

                    [
                        'kode' => 'SIKOLA-' . strtoupper(Str::random(10)),

                        'nominal' => $reward->nilai_reward,

                        'status' => 'aktif',

                        'berlaku_mulai' => now(),

                        'berlaku_sampai' => now()->addMonth(),

                        'order_id' => null,
                        'digunakan_pada' => null,
                    ]

                );

            }

        }
    }
}
