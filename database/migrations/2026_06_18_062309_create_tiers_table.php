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
        Schema::create('tiers', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50);
            $table->unsignedInteger('min_poin');
            $table->unsignedInteger('max_poin')->nullable();    // null = Diamond (unlimited)
            $table->string('badge_icon')->nullable();
            $table->string('warna_hex', 7);
            $table->text('deskripsi')->nullable();
            $table->json('keuntungan')->nullable();
            $table->unsignedTinyInteger('urutan')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiers');
    }
};
