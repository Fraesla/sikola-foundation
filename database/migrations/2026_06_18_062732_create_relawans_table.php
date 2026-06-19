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
        Schema::create('relawans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();
            // ─ Identitas diri ─
            $table->string('nik', 20)->nullable();
            $table->string('tempat_lahir', 100)->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_telepon', 20)->nullable();
            $table->string('pekerjaan', 100)->nullable();
            $table->string('pendidikan', 100)->nullable();
            // ─ Formulir relawan ─
            $table->text('motivasi')->nullable();
            $table->text('keahlian')->nullable();
            $table->text('pengalaman_organisasi')->nullable();
            $table->string('foto_ktp', 500)->nullable();      // private storage
            // ─ Status approval ─
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])
                   ->default('menunggu');
            $table->text('catatan_admin')->nullable();
            $table->foreignId('disetujui_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('disetujui_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relawans');
    }
};
