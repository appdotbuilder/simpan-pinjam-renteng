<?php

namespace Database\Factories;

use App\Models\Kelompok;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kelompok>
 */
class KelompokFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Kelompok>
     */
    protected $model = Kelompok::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_kelompok' => 'Kelompok ' . $this->faker->company(),
            'alamat' => $this->faker->address(),
            'ketua_kelompok' => $this->faker->name(),
            'kontak_ketua' => $this->faker->phoneNumber(),
            'status' => $this->faker->randomElement(['aktif', 'tidak_aktif', 'pending']),
            'keterangan' => $this->faker->optional()->sentence(),
            'tanggal_daftar' => $this->faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
        ];
    }

    /**
     * Indicate that the kelompok is active.
     */
    public function aktif(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'aktif',
        ]);
    }
}