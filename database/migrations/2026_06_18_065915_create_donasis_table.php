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
        Schema::create('donasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('dontaion_category_id')
                   ->nullable()
                   ->constrained('donasi_kategori')
                   ->nullOnDelete();
            $table->foreignId('langganan_id')
                   ->nullable()
                   ->constrained('donasi_langganans')
                   ->nullOnDelete();
            $table->enum('tipe', ['sekali', 'bulanan']);
            $table->decimal('jumlah', 15, 2);
            $table->text('pesan')->nullable();
            $table->string('bukti_transfer', 500)->nullable();   // path private storage
            $table->enum('status', ['menunggu', 'dikonfirmasi', 'ditolak'])
                   ->default('menunggu');
            $table->text('alasan_tolak')->nullable();
            $table->unsignedInteger('poin_diberikan')->default(0);
            $table->foreignId('dikonfirmasi_oleh')
                   ->nullable()
                   ->constrained('users')
                   ->nullOnDelete();
            $table->timestamp('dikonfirmasi_at')->nullable();
            $table->timestamps();
            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donasis');
    }
};
