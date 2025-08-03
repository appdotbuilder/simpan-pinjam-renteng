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
        Schema::create('anggotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelompok_id')->constrained('kelompoks')->onDelete('cascade');
            $table->string('nama_lengkap');
            $table->string('nik')->unique();
            $table->text('alamat');
            $table->string('no_hp');
            $table->string('jenis_usaha');
            $table->decimal('omzet_bulanan', 15, 2)->nullable();
            $table->enum('status', ['aktif', 'tidak_aktif', 'pending'])->default('pending');
            $table->date('tanggal_bergabung');
            $table->timestamps();
            
            $table->index('nama_lengkap');
            $table->index('nik');
            $table->index('status');
            $table->index(['kelompok_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};