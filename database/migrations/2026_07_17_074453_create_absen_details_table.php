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
        Schema::create('absen_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('absensi_id')->constrained('absensis')->cascadeOnDelete();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->foreignId('event_peserta_id')->constrained('pesertas')->cascadeOnDelete();
            $table->unsignedTinyInteger('hari_ke');
            /*
            |--------------------------------------------------------------------------
            | Log Scan
            |--------------------------------------------------------------------------
            */
            $table->timestamp('waktu_scan');
            $table->enum('status',[
                'hadir',
                'tidak_hadir'
            ]);
            // $table->enum('tipe',[
            //     'masuk',
            //     'scan',
            //     'keluar'
            // ])->default('scan');
            $table->unsignedInteger('scan_ke');
            $table->boolean('valid')->default(true);
            $table->unsignedInteger('durasi')->default(0)->comment('Detik sejak scan sebelumnya');
            $table->string('device')->nullable();
            $table->string('ip_address',45)->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->index(['event_peserta_id','hari_ke']);
            $table->index(['event_id','hari_ke']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absen_details');
    }
};
