<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EventCategorySeeder extends Seeder
{
     /**
     * Run the database seeds.
     */
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [

            [
                'judul' => 'Seminar Nasional Pendidikan',
                'deskripsi' => 'Seminar nasional mengenai inovasi pendidikan di era digital.',
                'lokasi' => 'Universitas Indonesia',
                'tanggal_mulai' => '2026-08-10 08:00:00',
                'tanggal_selesai' => '2026-08-10 16:00:00',
                'kuota' => 300,
                'poin_reward' => 100,
                'poin_penalty' => 50,
                'interval_scan' => 10,
                'toleransi_scan' => 3,
                'status' => 'terbuka',
            ],

            [
                'judul' => 'Workshop Public Speaking',
                'deskripsi' => 'Pelatihan meningkatkan kemampuan public speaking.',
                'lokasi' => 'Bandung',
                'tanggal_mulai' => '2026-08-18 09:00:00',
                'tanggal_selesai' => '2026-08-18 15:00:00',
                'kuota' => 100,
                'poin_reward' => 75,
                'poin_penalty' => 50,
                'interval_scan' => 15,
                'toleransi_scan' => 5,
                'status' => 'terbuka',
            ],

            [
                'judul' => 'Donor Darah Bersama',
                'deskripsi' => 'Kegiatan donor darah bersama PMI.',
                'lokasi' => 'Gedung Serbaguna',
                'tanggal_mulai' => '2026-09-01 08:00:00',
                'tanggal_selesai' => '2026-09-01 13:00:00',
                'kuota' => 250,
                'poin_reward' => 50,
                'poin_penalty' => 50,
                'interval_scan' => 10,
                'toleransi_scan' => 3,
                'status' => 'terbuka',
            ],

            [
                'judul' => 'Bakti Sosial Desa Binaan',
                'deskripsi' => 'Kegiatan pengabdian masyarakat bersama relawan.',
                'lokasi' => 'Kabupaten Bogor',
                'tanggal_mulai' => '2026-09-15 07:00:00',
                'tanggal_selesai' => '2026-09-16 17:00:00',
                'kuota' => 150,
                'poin_reward' => 150,
                'poin_penalty' => 50,
                'interval_scan' => 15,
                'toleransi_scan' => 5,
                'status' => 'draft',
            ],

            [
                'judul' => 'Volunteer Gathering',
                'deskripsi' => 'Silaturahmi dan evaluasi relawan.',
                'lokasi' => 'Jakarta',
                'tanggal_mulai' => '2026-10-05 09:00:00',
                'tanggal_selesai' => '2026-10-05 15:00:00',
                'kuota' => 200,
                'poin_reward' => 80,
                'poin_penalty' => 50,
                'interval_scan' => 10,
                'toleransi_scan' => 3,
                'status' => 'terbuka',
            ],

            [
                'judul' => 'Charity Fun Run',
                'deskripsi' => 'Lari amal untuk penggalangan dana pendidikan.',
                'lokasi' => 'GBK Jakarta',
                'tanggal_mulai' => '2026-10-20 06:00:00',
                'tanggal_selesai' => '2026-10-20 11:00:00',
                'kuota' => 500,
                'poin_reward' => 120,
                'poin_penalty' => 50,
                'interval_scan' => 5,
                'toleransi_scan' => 2,
                'status' => 'terbuka',
            ],

            [
                'judul' => 'Pelatihan Relawan Baru',
                'deskripsi' => 'Pelatihan dasar untuk relawan baru.',
                'lokasi' => 'Yogyakarta',
                'tanggal_mulai' => '2026-11-05 08:00:00',
                'tanggal_selesai' => '2026-11-06 16:00:00',
                'kuota' => 120,
                'poin_reward' => 100,
                'poin_penalty' => 50,
                'interval_scan' => 10,
                'toleransi_scan' => 3,
                'status' => 'terbuka',
            ],

            [
                'judul' => 'Festival UMKM Sosial',
                'deskripsi' => 'Pameran produk UMKM binaan.',
                'lokasi' => 'Surabaya',
                'tanggal_mulai' => '2026-11-18 09:00:00',
                'tanggal_selesai' => '2026-11-20 21:00:00',
                'kuota' => 1000,
                'poin_reward' => 50,
                'poin_penalty' => 50,
                'interval_scan' => 30,
                'toleransi_scan' => 10,
                'status' => 'draft',
            ],

            [
                'judul' => 'Konser Amal Indonesia Peduli',
                'deskripsi' => 'Konser amal untuk membantu korban bencana.',
                'lokasi' => 'Bandung',
                'tanggal_mulai' => '2026-12-12 18:00:00',
                'tanggal_selesai' => '2026-12-12 22:00:00',
                'kuota' => 800,
                'poin_reward' => 200,
                'poin_penalty' => 50,
                'interval_scan' => 5,
                'toleransi_scan' => 2,
                'status' => 'terbuka',
            ],

            [
                'judul' => 'Malam Apresiasi Relawan',
                'deskripsi' => 'Penghargaan bagi relawan terbaik.',
                'lokasi' => 'Jakarta',
                'tanggal_mulai' => '2026-12-20 19:00:00',
                'tanggal_selesai' => '2026-12-20 22:00:00',
                'kuota' => 300,
                'poin_reward' => 100,
                'poin_penalty' => 50,
                'interval_scan' => 10,
                'toleransi_scan' => 3,
                'status' => 'selesai',
            ],

        ];

        foreach ($events as $event) {

            DB::table('events')->insert([

                'judul'            => $event['judul'],
                'slug'             => Str::slug($event['judul']),
                'deskripsi'        => $event['deskripsi'],
                'gambar'           => null,
                'lokasi'           => $event['lokasi'],
                'tanggal_mulai'    => $event['tanggal_mulai'],
                'tanggal_selesai'  => $event['tanggal_selesai'],
                'kuota'            => $event['kuota'],

                // Reward & Penalty
                'poin_reward'      => $event['poin_reward'],
                'poin_penalty'     => $event['poin_penalty'],

                // Simulasi Absensi
                'interval_scan'    => $event['interval_scan'],
                'toleransi_scan'   => $event['toleransi_scan'],

                'status'           => $event['status'],
                'created_by'       => 1,

                'created_at'       => Carbon::now(),
                'updated_at'       => Carbon::now(),

            ]);

        }
    }
}
