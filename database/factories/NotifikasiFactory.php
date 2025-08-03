<?php

namespace Database\Factories;

use App\Models\Notifikasi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notifikasi>
 */
class NotifikasiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\App\Models\Notifikasi>
     */
    protected $model = Notifikasi::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $judulTemplates = [
            'Pengajuan Pinjaman Baru',
            'Angsuran Jatuh Tempo',
            'Pembayaran Diterima',
            'Verifikasi Diperlukan',
            'Pinjaman Disetujui',
            'Tanggung Renteng Aktif',
            'Reminder Pembayaran',
            'Status Pinjaman Diperbarui',
        ];

        $pesanTemplates = [
            'Pengajuan pinjaman baru memerlukan verifikasi Anda.',
            'Angsuran akan jatuh tempo dalam 3 hari.',
            'Pembayaran angsuran telah diterima dan diproses.',
            'Dokumen pengajuan memerlukan verifikasi tambahan.',
            'Selamat! Pinjaman Anda telah disetujui.',
            'Sistem tanggung renteng telah diaktifkan untuk kelompok Anda.',
            'Jangan lupa melakukan pembayaran angsuran tepat waktu.',
            'Status pinjaman Anda telah diperbarui.',
        ];

        return [
            'user_id' => User::factory(),
            'judul' => $this->faker->randomElement($judulTemplates),
            'pesan' => $this->faker->randomElement($pesanTemplates),
            'tipe' => $this->faker->randomElement(['info', 'warning', 'success', 'error']),
            'dibaca' => $this->faker->boolean(30), // 30% chance of being read
            'link' => $this->faker->optional(0.5)->url(),
            'data' => null,
        ];
    }

    /**
     * Indicate that the notification is unread.
     */
    public function belumDibaca(): static
    {
        return $this->state(fn (array $attributes) => [
            'dibaca' => false,
        ]);
    }
}