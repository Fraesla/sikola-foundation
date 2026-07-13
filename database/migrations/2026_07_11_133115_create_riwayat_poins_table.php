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
        Schema::create('riwayat_poins', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('tipe',[
                'masuk',
                'keluar'
            ]);

            $table->unsignedInteger('poin');

            $table->enum('kategori',[
                'registrasi',
                'donasi_sekali',
                'donasi_bulanan',
                'merchandise',
                'event',
                'reward',
                'manual',
            ]);

            $table->nullableMorphs('referensi');

            $table->text('keterangan')->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riwayat_poins');
    }
};
