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
        Schema::create('merchandises', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->decimal('harga', 15, 2);
            $table->unsignedInteger('stok')->default(0);
            $table->json('gambar')->nullable();                  // array path gambar
            $table->string('kategori', 100)->nullable();
            $table->unsignedInteger('berat_gram')->default(0);
            $table->unsignedInteger('poin_reward')->default(0);    // 1 poin / Rp20.000
            $table->boolean('is_aktif')->default(true);
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            $table->index(['is_aktif', 'kategori']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchandises');
    }
};
