<?php

namespace Database\Factories;

use App\Models\Anggota;
use App\Models\Angsuran;
use App\Models\TanggungRenteng;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TanggungRenteng>
 */
class TanggungRentengFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\TanggungRenteng>
     */
    protected $model = TanggungRenteng::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'angsuran_id' => Angsuran::factory(),
            'anggota_penanggung_id' => Anggota::factory(),
            'jumlah_tanggung' => $this->faker->randomFloat(2, 100000, 2000000),
            'tanggal_tanggung' => $this->faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'status' => $this->faker->randomElement(['pending', 'dibayar', 'dikembalikan']),
            'tanggal_kembali' => $this->faker->optional(0.3)->passthrough($this->faker->dateTimeBetween('now', '+6 months')->format('Y-m-d')),
            'keterangan' => $this->faker->optional()->sentence(),
        ];
    }

    /**
     * Indicate that the tanggung renteng is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'tanggal_kembali' => null,
        ]);
    }
}