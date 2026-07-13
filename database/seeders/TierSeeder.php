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
                'nama'        => 'Perunggu',
                'min_poin'    => 0,
                'max_poin'    => 500,
                'warna_hex'   => '#CD7F32',
                'urutan'      => 1,

                'deskripsi'   => 'Tier awal untuk seluruh anggota Sikola Foundation.',

                'keuntungan'  => [
                    'Mengumpulkan poin',
                    'Riwayat donasi',
                    'Riwayat merchandise',
                    'Riwayat event',
                ],
            ],

            [
                'nama'        => 'Perak',
                'min_poin'    => 501,
                'max_poin'    => 2000,
                'warna_hex'   => '#C0C0C0',
                'urutan'      => 2,

                'deskripsi'   => 'Anggota aktif yang telah rutin berkontribusi.',

                'keuntungan'  => [
                    'Semua keuntungan Perunggu',
                    'Badge Perak',
                    'Prioritas informasi event',
                ],
            ],

            [
                'nama'        => 'Emas',
                'min_poin'    => 2001,
                'max_poin'    => 5000,
                'warna_hex'   => '#D4AF37',
                'urutan'      => 3,

                'deskripsi'   => 'Pendukung setia Sikola Foundation.',

                'keuntungan'  => [
                    'Semua keuntungan Perak',
                    'Diskon Merchandise 5%',
                    'Undangan Event Khusus',
                    'Badge Emas',
                ],
            ],

            [
                'nama'        => 'Platinum',
                'min_poin'    => 5001,
                'max_poin'    => 10000,
                'warna_hex'   => '#E5E4E2',
                'urutan'      => 4,

                'deskripsi'   => 'Kontributor utama Sikola Foundation.',

                'keuntungan'  => [
                    'Semua keuntungan Emas',
                    'Diskon Merchandise 10%',
                    'Prioritas Event',
                    'Nama pada halaman apresiasi',
                    'Badge Platinum',
                ],
            ],

            [
                'nama'        => 'Diamond',
                'min_poin'    => 10001,
                'max_poin'    => null,
                'warna_hex'   => '#7DF9FF',
                'urutan'      => 5,

                'deskripsi'   => 'Tier tertinggi bagi kontributor terbaik Sikola Foundation.',

                'keuntungan'  => [
                    'Semua keuntungan Platinum',
                    'Diskon Merchandise 15%',
                    'Undangan seluruh Event Premium',
                    'Prioritas Reward',
                    'Laporan Tahunan Yayasan',
                    'Sertifikat Penghargaan',
                    'Badge Diamond',
                ],
            ],

        ];

        foreach ($tiers as $tier) {

            Tier::updateOrCreate(

                [
                    'nama' => $tier['nama'],
                ],

                [
                    'min_poin'   => $tier['min_poin'],
                    'max_poin'   => $tier['max_poin'],
                    'warna_hex'  => $tier['warna_hex'],
                    'urutan'     => $tier['urutan'],
                    'deskripsi'  => $tier['deskripsi'],
                    'keuntungan' => $tier['keuntungan'],
                ]

            );

        }
    }
}
