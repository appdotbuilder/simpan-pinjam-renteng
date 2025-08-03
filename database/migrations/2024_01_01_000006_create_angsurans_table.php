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
        Schema::create('angsurans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pinjaman_id')->constrained('pinjamen')->onDelete('cascade');
            $table->integer('angsuran_ke');
            $table->decimal('jumlah_angsuran', 15, 2);
            $table->decimal('pokok', 15, 2);
            $table->decimal('bunga', 15, 2);
            $table->date('tanggal_jatuh_tempo');
            $table->date('tanggal_bayar')->nullable();
            $table->decimal('jumlah_dibayar', 15, 2)->default(0);
            $table->enum('status', ['belum_bayar', 'sebagian', 'lunas', 'terlambat'])->default('belum_bayar');
            $table->integer('hari_terlambat')->default(0);
            $table->decimal('denda', 15, 2)->default(0);
            $table->timestamps();
            
            $table->index(['pinjaman_id', 'angsuran_ke']);
            $table->index('status');
            $table->index('tanggal_jatuh_tempo');
            $table->index(['tanggal_jatuh_tempo', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('angsurans');
    }
};