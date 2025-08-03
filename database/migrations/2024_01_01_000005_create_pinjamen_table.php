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
        Schema::create('pinjamen', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pinjaman')->unique();
            $table->foreignId('kelompok_id')->constrained('kelompoks')->onDelete('cascade');
            $table->foreignId('anggota_id')->constrained('anggotas')->onDelete('cascade');
            $table->decimal('jumlah_pinjaman', 15, 2);
            $table->decimal('bunga_persen', 5, 2);
            $table->integer('tenor_bulan');
            $table->decimal('angsuran_bulanan', 15, 2);
            $table->enum('tujuan_pinjaman', ['modal_kerja', 'investasi', 'konsumsi', 'lainnya']);
            $table->text('keterangan_tujuan')->nullable();
            $table->enum('status', ['pengajuan', 'verifikasi', 'disetujui', 'ditolak', 'dicairkan', 'aktif', 'lunas', 'macet'])->default('pengajuan');
            $table->text('catatan_petugas')->nullable();
            $table->foreignId('petugas_verifikasi_id')->nullable()->constrained('users');
            $table->foreignId('manager_persetujuan_id')->nullable()->constrained('users');
            $table->date('tanggal_pengajuan');
            $table->date('tanggal_verifikasi')->nullable();
            $table->date('tanggal_persetujuan')->nullable();
            $table->date('tanggal_pencairan')->nullable();
            $table->date('tanggal_jatuh_tempo')->nullable();
            $table->timestamps();
            
            $table->index('nomor_pinjaman');
            $table->index('status');
            $table->index(['kelompok_id', 'status']);
            $table->index(['anggota_id', 'status']);
            $table->index('tanggal_pengajuan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjamen');
    }
};