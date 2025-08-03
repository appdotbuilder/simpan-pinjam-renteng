<?php

namespace Database\Factories;

use App\Models\Anggota;
use App\Models\Kelompok;
use App\Models\Pinjaman;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pinjaman>
 */
class PinjamanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Pinjaman>
     */
    protected $model = Pinjaman::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jumlahPinjaman = $this->faker->randomFloat(2, 5000000, 100000000);
        $bungaPersen = $this->faker->randomFloat(2, 12, 24);
        $tenorBulan = $this->faker->randomElement([6, 12, 18, 24, 36]);
        
        // Simple calculation for monthly installment
        $angsuranBulanan = ($jumlahPinjaman * (1 + ($bungaPersen / 100))) / $tenorBulan;

        return [
            'nomor_pinjaman' => 'PJ-' . now()->format('Ym') . '-' . $this->faker->unique()->numerify('####'),
            'kelompok_id' => Kelompok::factory(),
            'anggota_id' => Anggota::factory(),
            'jumlah_pinjaman' => $jumlahPinjaman,
            'bunga_persen' => $bungaPersen,
            'tenor_bulan' => $tenorBulan,
            'angsuran_bulanan' => $angsuranBulanan,
            'tujuan_pinjaman' => $this->faker->randomElement(['modal_kerja', 'investasi', 'konsumsi', 'lainnya']),
            'keterangan_tujuan' => $this->faker->optional()->sentence(),
            'status' => $this->faker->randomElement(['pengajuan', 'verifikasi', 'disetujui', 'ditolak', 'dicairkan', 'aktif', 'lunas', 'macet']),
            'catatan_petugas' => $this->faker->optional()->sentence(),
            'tanggal_pengajuan' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
        ];
    }

    /**
     * Indicate that the pinjaman is active.
     */
    public function aktif(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'aktif',
        ]);
    }
}