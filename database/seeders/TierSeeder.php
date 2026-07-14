<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tier;

class TierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tiers = [

            [
                'nama' => 'Perunggu',
                'min_poin' => 0,
                'max_poin' => 500,
                'badge_icon' => '🥉',
                'warna_hex' => '#CD7F32',
                'deskripsi' => 'Tier awal untuk seluruh anggota Sikola Foundation.',
                'keuntungan' => json_encode([
                    'Mengumpulkan poin',
                    'Riwayat donasi',
                    'Riwayat merchandise',
                    'Riwayat event'
                ]),
                'urutan' => 1,
                'diskon_merchandise' => 0,
                'bonus_poin' => 0,
                'prioritas_event' => false,
                'gratis_ongkir' => false,
                'aktif' => true,
            ],

            [
                'nama' => 'Perak',
                'min_poin' => 501,
                'max_poin' => 2000,
                'badge_icon' => '🥈',
                'warna_hex' => '#C0C0C0',
                'deskripsi' => 'Anggota yang rutin berkontribusi.',
                'keuntungan' => json_encode([
                    'Semua keuntungan Perunggu',
                    'Badge Perak',
                    'Prioritas informasi kegiatan'
                ]),
                'urutan' => 2,
                'diskon_merchandise' => 3,
                'bonus_poin' => 10,
                'prioritas_event' => false,
                'gratis_ongkir' => false,
                'aktif' => true,
            ],

            [
                'nama' => 'Emas',
                'min_poin' => 2001,
                'max_poin' => 5000,
                'badge_icon' => '🥇',
                'warna_hex' => '#D4AF37',
                'deskripsi' => 'Pendukung aktif Sikola Foundation.',
                'keuntungan' => json_encode([
                    'Semua keuntungan Perak',
                    'Diskon merchandise',
                    'Undangan event khusus',
                    'Badge Emas'
                ]),
                'urutan' => 3,
                'diskon_merchandise' => 5,
                'bonus_poin' => 25,
                'prioritas_event' => true,
                'gratis_ongkir' => false,
                'aktif' => true,
            ],

            [
                'nama' => 'Platinum',
                'min_poin' => 5001,
                'max_poin' => 10000,
                'badge_icon' => '💎',
                'warna_hex' => '#E5E4E2',
                'deskripsi' => 'Kontributor utama Sikola Foundation.',
                'keuntungan' => json_encode([
                    'Semua keuntungan Emas',
                    'Diskon merchandise lebih besar',
                    'Prioritas event',
                    'Badge Platinum'
                ]),
                'urutan' => 4,
                'diskon_merchandise' => 10,
                'bonus_poin' => 50,
                'prioritas_event' => true,
                'gratis_ongkir' => true,
                'aktif' => true,
            ],

            [
                'nama' => 'Diamond',
                'min_poin' => 10001,
                'max_poin' => null,
                'badge_icon' => '💠',
                'warna_hex' => '#B9F2FF',
                'deskripsi' => 'Tier tertinggi bagi kontributor terbaik Sikola Foundation.',
                'keuntungan' => json_encode([
                    'Semua keuntungan Platinum',
                    'Diskon merchandise terbesar',
                    'Gratis ongkir',
                    'Prioritas seluruh event',
                    'Bonus poin setiap transaksi',
                    'Sertifikat penghargaan',
                    'Badge Diamond'
                ]),
                'urutan' => 5,
                'diskon_merchandise' => 15,
                'bonus_poin' => 100,
                'prioritas_event' => true,
                'gratis_ongkir' => true,
                'aktif' => true,
            ],

        ];

        foreach ($tiers as $tier) {

            Tier::updateOrCreate(

                [
                    'nama' => $tier['nama'],
                ],

                $tier

            );

        }
    }
}
