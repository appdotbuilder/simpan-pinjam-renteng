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
        Schema::create('kelompoks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelompok');
            $table->text('alamat');
            $table->string('ketua_kelompok');
            $table->string('kontak_ketua');
            $table->enum('status', ['aktif', 'tidak_aktif', 'pending'])->default('pending');
            $table->text('keterangan')->nullable();
            $table->date('tanggal_daftar');
            $table->timestamps();
            
            $table->index('nama_kelompok');
            $table->index('status');
            $table->index('tanggal_daftar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelompoks');
    }
};