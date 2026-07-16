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
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rewards = [

            [
                'nama' => 'Saldo DANA Rp50.000',
                'slug' => 'saldo-dana-50k',
                'deskripsi' => 'Redeem poin menjadi saldo DANA sebesar Rp50.000.',
                'gambar' => null,
                'kategori' => 'Saldo',
                'poin' => 2500,
                'stok' => 999,
                'urutan' => 1,
                'is_aktif' => true,
                'created_by' => 1,
            ],

            [
                'nama' => 'Saldo DANA Rp100.000',
                'slug' => 'saldo-dana-100k',
                'deskripsi' => 'Redeem poin menjadi saldo DANA sebesar Rp100.000.',
                'gambar' => null,
                'kategori' => 'Saldo',
                'poin' => 5000,
                'stok' => 999,
                'urutan' => 2,
                'is_aktif' => true,
                'created_by' => 1,
            ],

            [
                'nama' => 'Saldo Tunai Rp50.000',
                'slug' => 'saldo-tunai-50k',
                'deskripsi' => 'Reward berupa transfer tunai sebesar Rp50.000.',
                'gambar' => null,
                'kategori' => 'Saldo',
                'poin' => 2500,
                'stok' => 999,
                'urutan' => 3,
                'is_aktif' => true,
                'created_by' => 1,
            ],

            [
                'nama' => 'Saldo Tunai Rp100.000',
                'slug' => 'saldo-tunai-100k',
                'deskripsi' => 'Reward berupa transfer tunai sebesar Rp100.000.',
                'gambar' => null,
                'kategori' => 'Saldo',
                'poin' => 5000,
                'stok' => 999,
                'urutan' => 4,
                'is_aktif' => true,
                'created_by' => 1,
            ],

            [
                'nama' => 'Kaos Official SIKOLA',
                'slug' => 'kaos-official-sikola',
                'deskripsi' => 'Kaos Official SIKOLA Foundation berbahan cotton combed premium.',
                'gambar' => null,
                'kategori' => 'Merchandise',
                'poin' => 1500,
                'stok' => 50,
                'urutan' => 5,
                'is_aktif' => true,
                'created_by' => 1,
            ],

            [
                'nama' => 'Tumbler Premium',
                'slug' => 'tumbler-premium',
                'deskripsi' => 'Tumbler stainless premium Official SIKOLA.',
                'gambar' => null,
                'kategori' => 'Merchandise',
                'poin' => 2000,
                'stok' => 40,
                'urutan' => 6,
                'is_aktif' => true,
                'created_by' => 1,
            ],

            [
                'nama' => 'Topi Official SIKOLA',
                'slug' => 'topi-official-sikola',
                'deskripsi' => 'Topi bordir Official SIKOLA Foundation.',
                'gambar' => null,
                'kategori' => 'Merchandise',
                'poin' => 1800,
                'stok' => 30,
                'urutan' => 7,
                'is_aktif' => true,
                'created_by' => 1,
            ],

            [
                'nama' => 'Tas Kanvas SIKOLA',
                'slug' => 'tas-kanvas-sikola',
                'deskripsi' => 'Tas kanvas ramah lingkungan Official SIKOLA.',
                'gambar' => null,
                'kategori' => 'Merchandise',
                'poin' => 2500,
                'stok' => 25,
                'urutan' => 8,
                'is_aktif' => true,
                'created_by' => 1,
            ],

            [
                'nama' => 'Payung Lipat Premium',
                'slug' => 'payung-lipat-premium',
                'deskripsi' => 'Payung lipat eksklusif dengan logo SIKOLA.',
                'gambar' => null,
                'kategori' => 'Merchandise',
                'poin' => 3500,
                'stok' => 20,
                'urutan' => 9,
                'is_aktif' => true,
                'created_by' => 1,
            ],

            [
                'nama' => 'Plakat Donatur Terbaik',
                'slug' => 'plakat-donatur-terbaik',
                'deskripsi' => 'Plakat penghargaan eksklusif untuk donatur terbaik.',
                'gambar' => null,
                'kategori' => 'Penghargaan',
                'poin' => 5000,
                'stok' => 10,
                'urutan' => 10,
                'is_aktif' => true,
                'created_by' => 1,
            ],

        ];

        foreach ($rewards as $reward) {

            Reward::updateOrCreate(
                [
                    'slug' => $reward['slug']
                ],
                $reward
            );

        }
    }
}
