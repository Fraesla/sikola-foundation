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
        Schema::create('reward_redemptions', function (Blueprint $table) {

            $table->id();

            // Kode transaksi
            $table->string('kode')->unique();

            // User yang melakukan redeem
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // Reward yang ditukar
            $table->foreignId('reward_id')
                ->constrained()
                ->cascadeOnDelete();

            // Jumlah reward
            $table->unsignedInteger('qty')->default(1);

            // Poin per item
            $table->unsignedInteger('poin');

            // Total poin yang dipotong
            $table->unsignedInteger('total_poin');

            // Status Redeem
            $table->enum('status', [
                'menunggu',
                'diproses',
                'selesai',
                'dibatalkan',
            ])->default('menunggu');

            // Catatan dari user
            $table->text('catatan_user')->nullable();

            // Catatan admin
            $table->text('catatan_admin')->nullable();

            // Bukti transfer / foto barang / bukti pengiriman
            $table->string('bukti_penyerahan')->nullable();

            // Ekspedisi (khusus reward fisik)
            $table->string('ekspedisi')->nullable();

            // Nomor Resi (khusus reward fisik)
            $table->string('nomor_resi')->nullable();

            // Admin yang memproses
            $table->foreignId('diproses_oleh')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Waktu diproses
            $table->timestamp('diproses_at')->nullable();

            // Waktu selesai
            $table->timestamp('selesai_at')->nullable();

            // Waktu dibatalkan
            $table->timestamp('dibatalkan_at')->nullable();

            $table->foreignId('dibatalkan_oleh')->nullable()->constrained('users');

            $table->enum('dibatalkan_sebagai', ['pembeli','donatur','relawan','admin'])->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reward_redemptions');
    }
};
