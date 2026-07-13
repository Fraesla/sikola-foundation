<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DonasiLangganan;

class UpdatePeriodeLanggananCommand extends Command
{
    protected $signature = 'langganan:update-periode';

    protected $description = 'Update periode langganan yang sudah jatuh tempo';

    public function handle(): int
    {
        $langganan = DonasiLangganan::where('is_aktif', true)
            ->whereDate('tanggal_akhir', '<', today())
            ->get();

        foreach ($langganan as $item) {

            $mulai = Carbon::parse($item->tanggal_mulai)
                ->addMonthNoOverflow();

            $akhir = Carbon::parse($item->tanggal_akhir)
                ->addMonthNoOverflow();

            $item->update([

                'tanggal_mulai' => $mulai,

                'tanggal_akhir' => $akhir,

            ]);

        }

        $this->info($langganan->count().' periode berhasil diperbarui.');

        return self::SUCCESS;
    }
}
