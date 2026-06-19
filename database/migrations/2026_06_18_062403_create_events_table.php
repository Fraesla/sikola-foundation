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
            $table->string('gambar', 500)->nullable();
            $table->string('lokasi')->nullable();
            $table->dateTime('tanggal_mulai');
            $table->dateTime('tanggal_selesai')->nullable();
            $table->unsignedInteger('kuota')->nullable();          // null = unlimited
            $table->unsignedInteger('poin_reward')->default(50);
            $table->enum('status', ['draft', 'terbuka', 'ditutup', 'selesai'])
                   ->default('draft');
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
            $table->index(['status', 'tanggal_mulai']);
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
