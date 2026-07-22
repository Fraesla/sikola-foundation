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
        Schema::create('absensis', function (Blueprint $table) {

            $table->id();

            $table->foreignId('event_id')
                ->constrained('events')
                ->cascadeOnDelete();

            $table->foreignId('event_peserta_id')
                ->constrained('pesertas')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('hari_ke');

            $table->date('tanggal');

            /*
            |--------------------------------------------------------------------------
            | Rekap Harian
            |--------------------------------------------------------------------------
            */

            $table->unsignedSmallInteger('target_scan')
                ->default(0);

            $table->unsignedSmallInteger('total_scan')
                ->default(0);

            $table->unsignedSmallInteger('hadir')
                ->default(0);

            $table->unsignedSmallInteger('tidak_hadir')
                ->default(0);

            $table->decimal('persentase',5,2)
                ->default(0);

            $table->enum('status',[
                'belum_absen',
                'hadir',
                'tidak_hadir'
            ])->default('belum_absen');

            $table->boolean('selesai')
                ->default(false);

            $table->timestamp('selesai_pada')
                ->nullable();

            $table->boolean('dibuat_otomatis')
                ->default(true);

            $table->text('catatan')
                ->nullable();

            $table->timestamps();

            $table->unique([
                'event_peserta_id',
                'hari_ke'
            ]);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
