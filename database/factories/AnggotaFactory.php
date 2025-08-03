<?php

namespace Database\Factories;

use App\Models\Anggota;
use App\Models\Kelompok;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Anggota>
 */
class AnggotaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Anggota>
     */
    protected $model = Anggota::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kelompok_id' => Kelompok::factory(),
            'nama_lengkap' => $this->faker->name(),
            'nik' => $this->faker->unique()->numerify('################'),
            'alamat' => $this->faker->address(),
            'no_hp' => $this->faker->phoneNumber(),
            'jenis_usaha' => $this->faker->randomElement([
                'Warung Kelontong',
                'Penjahit',
                'Bengkel Motor',
                'Salon Kecantikan',
                'Warung Makan',
                'Toko Kue',
                'Jasa Laundry',
                'Pertanian',
                'Peternakan',
                'Kerajinan Tangan'
            ]),
            'omzet_bulanan' => $this->faker->randomFloat(2, 1000000, 50000000),
            'status' => $this->faker->randomElement(['aktif', 'tidak_aktif', 'pending']),
            'tanggal_bergabung' => $this->faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
        ];
    }

    /**
     * Indicate that the anggota is active.
     */
    public function aktif(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'aktif',
        ]);
    }
}