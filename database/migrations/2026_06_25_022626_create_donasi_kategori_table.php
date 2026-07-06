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
        Schema::create('donasi_kategori', function (Blueprint $table) {
           $table->id();

            $table->string('nama');
            $table->string('slug')->unique();

            $table->text('deskripsi')->nullable();

            // gambar/icon
            $table->string('icon')->nullable();
            $table->string('gambar')->nullable();

            // nominal
            $table->decimal('minimal_donasi', 15, 2)->default(10000);
            $table->decimal('maksimal_donasi', 15, 2)->nullable();

            // target kategori
            $table->decimal('target_default', 15, 2)->default(0);

            // lokasi
            $table->string('lokasi')->nullable();

            // status
            $table->boolean('is_aktif')->default(true);

            $table->foreignId('created_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();

            $table->timestamps();

            $table->index(['is_aktif']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('donasi_kategori', function (Blueprint $table) {

        $table->dropColumn([
            'minimal_donasi',
            'maksimal_donasi',
            'lokasi'
            ]);
        });
    }
};
