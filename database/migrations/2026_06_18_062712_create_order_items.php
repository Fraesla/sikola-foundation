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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('merchandise_id')->constrained();
            $table->string('nama_produk');          // snapshot nama produk saat checkout
            $table->decimal('harga_satuan', 15, 2); // snapshot harga saat checkout
            $table->unsignedInteger('kuantitas')->default(1);
            $table->decimal('subtotal', 15, 2);
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
