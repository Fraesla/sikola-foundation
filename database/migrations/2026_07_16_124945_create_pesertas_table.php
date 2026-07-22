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
        Schema::create('pesertas', function (Blueprint $table) {

            $table->id();

            $table->foreignId('event_id')
                ->constrained('events')
                ->cascadeOnDelete();

            $table->foreignId('event_registrasi_id')
                ->constrained('events_registrasis')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Hasil Event
            |--------------------------------------------------------------------------
            */

            $table->enum('status',[
                'aktif',
                'lulus',
                'tidak_lulus',
                'noaktif'
            ])->default('aktif');

            $table->unsignedInteger('poin')->default(0);

            $table->unsignedInteger('total_scan')->default(0);

            $table->unsignedInteger('total_hadir')->default(0);

            $table->unsignedInteger('total_tidak_hadir')->default(0);

            $table->decimal('persentase_kehadiran',5,2)
                ->default(0);

            $table->string('nomor_sertifikat')
            ->nullable()
            ->unique();

            $table->string('sertifikat')->nullable();

            $table->timestamp('sertifikat_diterbitkan')
                ->nullable();

            $table->timestamp('lulus_pada')->nullable();

            $table->boolean('poin_berikan')
                ->default(false);

            $table->text('catatan')->nullable();

            $table->timestamps();

            $table->unique([
                'event_id',
                'user_id'
            ]);

        });
    } 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }
};
