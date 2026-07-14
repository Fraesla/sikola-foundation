<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DonationCategory;

class DonationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [

            [
                'nama'             => 'Bencana Alam',
                'slug'             => 'bencana-alam',
                'deskripsi'        => 'Membantu korban bencana alam di seluruh Indonesia.',
                'icon'             => 'fa-solid fa-house-crack',
                'gambar'           => null,
                'minimal_donasi'   => 10000,
                'maksimal_donasi'  => null,
                'target_default'   => 100000000,
                'lokasi'           => 'Indonesia',
                'is_aktif'         => true,
            ],

            [
                'nama'             => 'Pendidikan',
                'slug'             => 'pendidikan',
                'deskripsi'        => 'Mendukung pendidikan anak-anak kurang mampu.',
                'icon'             => 'fa-solid fa-school',
                'gambar'           => null,
                'minimal_donasi'   => 10000,
                'maksimal_donasi'  => null,
                'target_default'   => 50000000,
                'lokasi'           => 'Indonesia',
                'is_aktif'         => true,
            ],

            [
                'nama'             => 'Kesehatan',
                'slug'             => 'kesehatan',
                'deskripsi'        => 'Bantuan biaya pengobatan dan kesehatan.',
                'icon'             => 'fa-solid fa-heart-pulse',
                'gambar'           => null,
                'minimal_donasi'   => 10000,
                'maksimal_donasi'  => null,
                'target_default'   => 75000000,
                'lokasi'           => 'Indonesia',
                'is_aktif'         => true,
            ],

            [
                'nama'             => 'Panti Asuhan',
                'slug'             => 'panti-asuhan',
                'deskripsi'        => 'Membantu kebutuhan anak-anak panti.',
                'icon'             => 'fa-solid fa-children',
                'gambar'           => null,
                'minimal_donasi'   => 10000,
                'maksimal_donasi'  => null,
                'target_default'   => 30000000,
                'lokasi'           => 'Indonesia',
                'is_aktif'         => true,
            ],

            [
                'nama'             => 'Masjid & Musholla',
                'slug'             => 'masjid',
                'deskripsi'        => 'Pembangunan dan renovasi masjid.',
                'icon'             => 'fa-solid fa-mosque',
                'gambar'           => null,
                'minimal_donasi'   => 10000,
                'maksimal_donasi'  => null,
                'target_default'   => 50000000,
                'lokasi'           => 'Indonesia',
                'is_aktif'         => true,
            ],

        ];

        foreach ($categories as $item) {

            DonationCategory::updateOrCreate(

                ['slug' => $item['slug']],

                $item

            );

        }
    }
}
