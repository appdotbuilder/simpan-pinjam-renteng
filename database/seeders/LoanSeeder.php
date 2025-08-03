<?php

namespace Database\Seeders;

use App\Models\Anggota;
use App\Models\Kelompok;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create manager user
        $manager = User::create([
            'name' => 'Manager Utama',
            'email' => 'manager@loangroup.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'is_active' => true,
        ]);

        // Create petugas user
        $petugas = User::create([
            'name' => 'Petugas Lapangan',
            'email' => 'petugas@loangroup.com',
            'password' => Hash::make('password'),
            'role' => 'petugas',
            'is_active' => true,
        ]);

        // Create test kelompoks
        $kelompoks = Kelompok::factory()->count(5)->aktif()->create();

        // Create anggotas for each kelompok
        foreach ($kelompoks as $kelompok) {
            $anggotas = Anggota::factory()->count(random_int(3, 8))->aktif()->create([
                'kelompok_id' => $kelompok->id,
            ]);

            // Create user accounts for some anggotas
            foreach ($anggotas->take(2) as $anggota) {
                User::create([
                    'name' => $anggota->nama_lengkap,
                    'email' => strtolower(str_replace(' ', '.', $anggota->nama_lengkap)) . '@example.com',
                    'password' => Hash::make('password'),
                    'role' => 'anggota',
                    'anggota_id' => $anggota->id,
                    'is_active' => true,
                ]);
            }
        }

        // Update existing user if it exists
        $existingUser = User::where('email', 'test@example.com')->first();
        if ($existingUser) {
            $firstAnggota = Anggota::first();
            $existingUser->update([
                'role' => 'anggota',
                'anggota_id' => $firstAnggota?->id,
                'is_active' => true,
            ]);
        }
    }
}