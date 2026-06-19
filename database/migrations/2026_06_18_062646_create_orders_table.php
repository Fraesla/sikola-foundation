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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('kode_order', 50)->unique();          // ORD-20250601-001
            $table->foreignId('user_id')->constrained();
            $table->decimal('total_harga', 15, 2);
            $table->decimal('ongkos_kirim', 15, 2)->default(0);
            $table->string('nama_penerima', 150);
            $table->string('no_telp_penerima', 20);
            $table->text('alamat_pengiriman');
            $table->string('kota')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kode_pos', 10)->nullable();
            $table->string('bukti_pembayaran', 500)->nullable();
            $table->enum('status', [
                'menunggu_pembayaran', 'menunggu_konfirmasi', 'dikonfirmasi',
                'diproses', 'dikirim', 'selesai', 'dibatalkan'
            ])->default('menunggu_pembayaran');
            $table->string('no_resi', 100)->nullable();
            $table->string('ekspedisi', 50)->nullable();
            $table->unsignedInteger('poin_diberikan')->default(0);
            $table->text('catatan')->nullable();
            $table->text('alasan_batal')->nullable();
            $table->foreignId('dikonfirmasi_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('dikonfirmasi_at')->nullable();
            $table->timestamps();
            $table->index(['status', 'created_at']);
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
