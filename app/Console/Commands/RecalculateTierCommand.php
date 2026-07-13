<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Services\TierService;


class RecalculateTierCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tier:recalculate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hitung ulang tier seluruh user';

    /**
     * Execute the console command.
     */
    public function handle(TierService $tierService)
    {
        $this->info('Menghitung ulang tier...');

        User::chunk(100, function ($users) use ($tierService) {

            foreach ($users as $user) {

                $tierService->hitungDanPerbaruiTier($user);

            }

        });

        $this->info('Selesai.');

        return self::SUCCESS;
    }
}
