<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MerchandiseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            [
                'nama' => 'Kaos Relawan Premium',
                'kategori' => 'Kaos',
                'harga' => 150000,
                'stok' => 100,
                'berat_gram' => 250,
                'poin_reward' => 150,
            ],

            [
                'nama' => 'Hoodie Peduli Sesama',
                'kategori' => 'Stiker',
                'harga' => 275000,
                'stok' => 50,
                'berat_gram' => 700,
                'poin_reward' => 300,
            ],

            [
                'nama' => 'Topi Volunteer',
                'kategori' => 'Topi',
                'harga' => 85000,
                'stok' => 80,
                'berat_gram' => 180,
                'poin_reward' => 80,
            ],

            [
                'nama' => 'Totebag Peduli',
                'kategori' => 'Tas',
                'harga' => 65000,
                'stok' => 120,
                'berat_gram' => 200,
                'poin_reward' => 60,
            ],

            [
                'nama' => 'Tumbler Stainless',
                'kategori' => 'Mug',
                'harga' => 120000,
                'stok' => 70,
                'berat_gram' => 400,
                'poin_reward' => 120,
            ],

            [
                'nama' => 'Gelang Premium',
                'kategori' => 'Aksesoris',
                'harga' => 80000,
                'stok' => 70,
                'berat_gram' => 230,
                'poin_reward' => 40,
            ],

        ];

        foreach ($data as $item) {

            DB::table('merchandises')->insert([

                'nama' => $item['nama'],
                'slug' => Str::slug($item['nama']),
                'deskripsi' => 'Deskripsi '.$item['nama'],
                'harga' => $item['harga'],
                'stok' => $item['stok'],
                'gambar' => null,
                'kategori' => $item['kategori'],
                'berat_gram' => $item['berat_gram'],
                'poin_reward' => $item['poin_reward'],
                'is_aktif' => 1,
                'created_by' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);

        }
    }
}
