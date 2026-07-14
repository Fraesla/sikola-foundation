<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ConfigPoin;

class ConfigPoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $configs = [

            [
                'kategori' => 'registrasi',
                'nama' => 'Bonus Registrasi',
                'nilai' => 100,
                'keterangan' => 'Poin saat pertama kali mendaftar.',
            ],

            [
                'kategori' => 'donasi_sekali',
                'nama' => 'Donasi Sekali',
                'nilai' => 1,
                'keterangan' => '1 poin setiap Rp10.000.',
            ],

            [
                'kategori' => 'donasi_bulanan',
                'nama' => 'Donasi Bulanan',
                'nilai' => 2,
                'keterangan' => '2 poin setiap Rp10.000.',
            ],

            [
                'kategori' => 'bonus_bulanan',
                'nama' => 'Bonus Target Bulanan',
                'nilai' => 20,
                'keterangan' => 'Bonus saat target langganan tercapai.',
            ],

            [
                'kategori' => 'merchandise',
                'nama' => 'Belanja Merchandise',
                'nilai' => 1,
                'keterangan' => '1 poin setiap Rp10.000.',
            ],

            [
                'kategori' => 'event',
                'nama' => 'Mengikuti Event',
                'nilai' => 100,
                'keterangan' => 'Bonus mengikuti event.',
            ],

            [
                'kategori' => 'review',
                'nama' => 'Memberikan Review',
                'nilai' => 25,
                'keterangan' => 'Poin memberikan ulasan.',
            ],

            [
                'kategori' => 'manual',
                'nama' => 'Manual Admin',
                'nilai' => 0,
                'keterangan' => 'Digunakan admin untuk menambah poin.',
            ],

        ];

        foreach ($configs as $config){

            ConfigPoin::updateOrCreate(

                ['kategori'=>$config['kategori']],

                $config

            );

        }

    }
}
