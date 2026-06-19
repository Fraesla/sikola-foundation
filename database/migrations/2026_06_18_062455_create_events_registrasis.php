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
        Schema::create('events_registrasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained();
            $table->enum('status', ['mendaftar','dikonfirmasi','hadir','tidak_hadir'])
                   ->default('mendaftar');
            $table->boolean('poin_diberikan')->default(false);
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->unique(['event_id', 'user_id']); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events_registrasis');
    }
};
