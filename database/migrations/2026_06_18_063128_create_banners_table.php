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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('gambar', 500);
            $table->string('url_tautan', 500)->nullable();
            $table->unsignedTinyInteger('urutan')->default(1);
            $table->boolean('is_aktif')->default(true);
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            $table->index(['urutan', 'is_aktif']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
