<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateDonasibulanCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'donasi:generate-bulanan';

    /**
     * Execute the console command.
     */
    public function handle() : void
    {
       $langganans = DonasiLangganan::where('is_aktif', true)
            ->where(function($q) {
                $q->whereNull('tanggal_akhir')
                  ->orWhere('tanggal_akhir', '>=', today());
            })->get();

        foreach ($langganans as $langganan) {
            Donasi::create([
                'user_id'      => $langganan->user_id,
                'langganan_id' => $langganan->id,
                'tipe'         => 'bulanan',
                'jumlah'       => $langganan->jumlah_bulanan,
                'status'       => 'menunggu',
            ]);
            // Kirim notifikasi pengingat upload bukti
            app(NotifikasiService::class)->pengingatDonasiBulanan($langganan->user);
        }
        $this->info("Generated {$langganans->count()} donasi bulanan.");
    }
}

// Daftarkan di bootstrap/app.php (Laravel 11+)
return Application::configure(basePath: dirname(__DIR__))
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('donasi:generate-bulanan')->monthlyOn(1, '08:00');
    })->create();
