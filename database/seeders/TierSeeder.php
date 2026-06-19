<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
                'deskripsi'   => 'Tier awal untuk semua anggota baru.',
                'keuntungan'  => ['Akses ke berita & artikel', 'Poin dari donasi & pembelian'],
            ],
            [
                'nama'        => 'Perak',
                'min_poin'    => 501,
                'max_poin'    => 2000,
                'warna_hex'   => '#C0C0C0',
                'urutan'      => 2,
                'deskripsi'   => 'Anggota aktif dengan kontribusi berkelanjutan.',
                'keuntungan'  => ['Semua keuntungan Perunggu', 'Badge khusus di profil'],
            ],
            [
                'nama'        => 'Emas',
                'min_poin'    => 2001,
                'max_poin'    => 5000,
                'warna_hex'   => '#D4A017',
                'urutan'      => 3,
                'deskripsi'   => 'Pendukung setia yayasan.',
                'keuntungan'  => ['Semua keuntungan Perak', 'Diskon 5% merchandise', 'Undangan event eksklusif'],
            ],
            [
                'nama'        => 'Platinum',
                'min_poin'    => 5001,
                'max_poin'    => 10000,
                'warna_hex'   => '#E5E4E2',
                'urutan'      => 4,
                'deskripsi'   => 'Kontributor utama yayasan.',
                'keuntungan'  => ['Semua keuntungan Emas', 'Diskon 10% merchandise', 'Nama tercantum di website'],
            ],
            [
                'nama'        => 'Diamond',
                'min_poin'    => 10001,
                'max_poin'    => null,             // tidak terbatas
                'warna_hex'   => '#B9F2FF',
                'urutan'      => 5,
                'deskripsi'   => 'Tier tertinggi — pilar utama Sikola Foundation.',
                'keuntungan'  => ['Semua keuntungan Platinum', 'Diskon 15% merchandise',
                                   'Plakat penghargaan tahunan', 'Akses laporan tahunan yayasan'],
            ],
        ];

        foreach ($tiers as $i => $tier) {
            Tier::create(array_merge($tier, ['keuntungan' => json_encode($tier['keuntungan'])]));
        }
    }
}
