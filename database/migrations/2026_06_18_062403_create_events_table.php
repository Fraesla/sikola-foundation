<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {

            $table->id();

            $table->string('judul');
            $table->string('slug')->unique();
            $table->longText('deskripsi');

            $table->string('gambar',500)->nullable();

            $table->string('lokasi')->nullable();

            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai');

            $table->unsignedInteger('kuota')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Reward
            |--------------------------------------------------------------------------
            */

            $table->unsignedInteger('poin_reward')->default(50);

            $table->unsignedInteger('poin_penalty')->default(50);

            /*
            |--------------------------------------------------------------------------
            | Simulasi Absensi
            |--------------------------------------------------------------------------
            */

            // scan setiap berapa menit

            $table->unsignedSmallInteger('interval_scan')
                ->default(10);

            // toleransi scan terlambat

            $table->unsignedSmallInteger('toleransi_scan')
                ->default(3);

            /*
            |--------------------------------------------------------------------------
            */

            $table->enum('status',[
                'draft',
                'terbuka',
                'ditutup',
                'selesai'
            ])->default('draft');

            $table->foreignId('created_by')
                ->constrained('users');

            $table->timestamps();

            $table->index([
                'status',
                'tanggal_mulai'
            ]);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
