<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reward;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $rewards = [

            [
                'nama' => 'Voucher Merchandise Rp25.000',
                'slug' => 'voucher-25k',
                'deskripsi' => 'Voucher potongan merchandise.',
                'gambar' => null,
                'stok' => 100,
                'poin' => 250,
                'is_aktif' => true,
            ],

            [
                'nama' => 'Voucher Merchandise Rp50.000',
                'slug' => 'voucher-50k',
                'deskripsi' => 'Voucher potongan merchandise.',
                'gambar' => null,
                'stok' => 100,
                'poin' => 500,
                'is_aktif' => true,
            ],

            [
                'nama' => 'Kaos Eksklusif Sikola',
                'slug' => 'kaos-sikola',
                'deskripsi' => 'Kaos Official Sikola Foundation.',
                'gambar' => null,
                'stok' => 50,
                'poin' => 1500,
                'is_aktif' => true,
            ],

            [
                'nama' => 'Tumbler Premium',
                'slug' => 'tumbler',
                'deskripsi' => 'Tumbler Stainless.',
                'gambar' => null,
                'stok' => 40,
                'poin' => 2000,
                'is_aktif' => true,
            ],

            [
                'nama' => 'Hoodie Official',
                'slug' => 'hoodie',
                'deskripsi' => 'Hoodie Eksklusif Sikola Foundation.',
                'gambar' => null,
                'stok' => 25,
                'poin' => 3500,
                'is_aktif' => true,
            ],

            [
                'nama' => 'Plakat Donatur Terbaik',
                'slug' => 'plakat',
                'deskripsi' => 'Penghargaan tahunan.',
                'gambar' => null,
                'stok' => 10,
                'poin' => 5000,
                'is_aktif' => true,
            ],

        ];

        foreach ($rewards as $reward){

            Reward::updateOrCreate(

                ['slug'=>$reward['slug']],

                $reward

            );

        }

    }
}
