<?php

namespace Database\Factories;

use App\Models\Angsuran;
use App\Models\Pinjaman;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Angsuran>
 */
class AngsuranFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Angsuran>
     */
    protected $model = Angsuran::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jumlahAngsuran = $this->faker->randomFloat(2, 500000, 5000000);
        $pokok = $jumlahAngsuran * 0.8;
        $bunga = $jumlahAngsuran * 0.2;

        return [
            'pinjaman_id' => Pinjaman::factory(),
            'angsuran_ke' => $this->faker->numberBetween(1, 36),
            'jumlah_angsuran' => $jumlahAngsuran,
            'pokok' => $pokok,
            'bunga' => $bunga,
            'tanggal_jatuh_tempo' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
            'tanggal_bayar' => $this->faker->optional(0.7)->passthrough($this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d')),
            'jumlah_dibayar' => $this->faker->randomFloat(2, 0, $jumlahAngsuran),
            'status' => $this->faker->randomElement(['belum_bayar', 'sebagian', 'lunas', 'terlambat']),
            'hari_terlambat' => $this->faker->numberBetween(0, 30),
            'denda' => $this->faker->randomFloat(2, 0, 100000),
        ];
    }

    /**
     * Indicate that the angsuran is overdue.
     */
    public function terlambat(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'terlambat',
            'hari_terlambat' => $this->faker->numberBetween(1, 90),
            'denda' => $this->faker->randomFloat(2, 50000, 500000),
        ]);
    }
}