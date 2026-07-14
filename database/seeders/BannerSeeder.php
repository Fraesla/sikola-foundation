<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('banners')->insert([

            // ================= HOME =================
            [
                'judul'       => 'Hero Banner Home 1',
                'deskripsi'   => 'Banner pertama pada halaman Home.',
                'gambar'      => null,
                'url_tautan'  => '/',
                'urutan'      => 1,
                'is_aktif'    => 1,
                'created_by'  => 1,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'judul'       => 'Hero Banner Home 2',
                'deskripsi'   => 'Banner kedua pada halaman Home.',
                'gambar'      => null,
                'url_tautan'  => '/',
                'urutan'      => 1,
                'is_aktif'    => 1,
                'created_by'  => 1,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'judul'       => 'Hero Banner Home 3',
                'deskripsi'   => 'Banner ketiga pada halaman Home.',
                'gambar'      => null,
                'url_tautan'  => '/',
                'urutan'      => 1,
                'is_aktif'    => 1,
                'created_by'  => 1,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],

            // ================= TENTANG =================
            [
                'judul'       => 'Hero Banner Tentang',
                'deskripsi'   => 'Banner halaman Tentang.',
                'gambar'      => null,
                'url_tautan'  => '/tentang',
                'urutan'      => 2,
                'is_aktif'    => 1,
                'created_by'  => 1,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],

            // ================= EVENT =================
            [
                'judul'       => 'Hero Banner Event',
                'deskripsi'   => 'Banner halaman Event.',
                'gambar'      => null,
                'url_tautan'  => '/event',
                'urutan'      => 3,
                'is_aktif'    => 1,
                'created_by'  => 1,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],

            // ================= DONASI =================
            [
                'judul'       => 'Hero Banner Donasi',
                'deskripsi'   => 'Banner halaman Donasi.',
                'gambar'      => null,
                'url_tautan'  => '/donasi',
                'urutan'      => 4,
                'is_aktif'    => 1,
                'created_by'  => 1,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],

            // ================= RELAWAN =================
            [
                'judul'       => 'Hero Banner Relawan',
                'deskripsi'   => 'Banner halaman Relawan.',
                'gambar'      => null,
                'url_tautan'  => '/relawan',
                'urutan'      => 5,
                'is_aktif'    => 1,
                'created_by'  => 1,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],

            // ================= BERITA =================
            [
                'judul'       => 'Hero Banner Berita',
                'deskripsi'   => 'Banner halaman Berita.',
                'gambar'      => null,
                'url_tautan'  => '/berita',
                'urutan'      => 6,
                'is_aktif'    => 1,
                'created_by'  => 1,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],

            // ================= MERCHANDISE =================
            [
                'judul'       => 'Hero Banner Merchandise',
                'deskripsi'   => 'Banner halaman Merchandise.',
                'gambar'      => null,
                'url_tautan'  => '/merchandise',
                'urutan'      => 7,
                'is_aktif'    => 1,
                'created_by'  => 1,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],

            // ================= TIM =================
            [
                'judul'       => 'Hero Banner Tim',
                'deskripsi'   => 'Banner halaman Tim.',
                'gambar'      => null,
                'url_tautan'  => '/tim',
                'urutan'      => 8,
                'is_aktif'    => 1,
                'created_by'  => 1,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],

            // ================= KONTAK =================
            [
                'judul'       => 'Hero Banner Kontak',
                'deskripsi'   => 'Banner halaman Kontak.',
                'gambar'      => null,
                'url_tautan'  => '/kontak',
                'urutan'      => 9,
                'is_aktif'    => 1,
                'created_by'  => 1,
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],

        ]);
    }
}
