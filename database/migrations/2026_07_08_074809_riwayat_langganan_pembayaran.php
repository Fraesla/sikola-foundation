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
        Schema::create('riwayat_langganan_pembayaran', function (Blueprint $table) {

            $table->id();

            $table->foreignId('langganan_id')
                ->constrained('donasi_langganans')
                ->cascadeOnDelete();

            $table->foreignId('donasi_id')
                ->constrained('donasis')
                ->cascadeOnDelete();

            $table->date('periode');
            $table->decimal('jumlah',15,2);

            $table->integer('poin');
            $table->integer('bonus');
            $table->date('bonus_periode');

            $table->string('bukti_transfer')->nullable();

            $table->enum('status',[
                'menunggu',
                'dikonfirmasi',
                'ditolak'
            ])->default('menunggu');

            $table->text('alasan_tolak')->nullable();

            $table->foreignId('dikonfirmasi_oleh')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('dikonfirmasi_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        chema::dropIfExists('riwayat_langganan_pembayaran');
    }
};
