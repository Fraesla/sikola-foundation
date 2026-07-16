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
        Schema::create('rewards', function (Blueprint $table) {

            $table->id();

            // Nama Reward
            $table->string('nama');

            // URL Friendly
            $table->string('slug')->unique();

            // Deskripsi
            $table->text('deskripsi')->nullable();

            // Foto Reward
            $table->string('gambar')->nullable();

            // Kategori bebas
            $table->string('kategori');

            // Harga dalam poin
            $table->unsignedInteger('poin');

            // Stok
            $table->unsignedInteger('stok')->default(0);

            // Urutan tampil
            $table->unsignedTinyInteger('urutan')->default(1);

            // Status
            $table->boolean('is_aktif')->default(true);

            // Admin pembuat
            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rewards');
    }
};