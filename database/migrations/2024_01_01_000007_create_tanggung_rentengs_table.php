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
        Schema::create('tanggung_rentengs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('angsuran_id')->constrained('angsurans')->onDelete('cascade');
            $table->foreignId('anggota_penanggung_id')->constrained('anggotas')->onDelete('cascade');
            $table->decimal('jumlah_tanggung', 15, 2);
            $table->date('tanggal_tanggung');
            $table->enum('status', ['pending', 'dibayar', 'dikembalikan'])->default('pending');
            $table->date('tanggal_kembali')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
            
            $table->index(['angsuran_id', 'anggota_penanggung_id']);
            $table->index('status');
            $table->index('tanggal_tanggung');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanggung_rentengs');
    }
};