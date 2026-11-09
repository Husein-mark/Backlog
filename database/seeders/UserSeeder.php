<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Guru (Pak Fajar)
        User::create([
            'name' => 'Pak Fajar',
            'email' => 'guru@sekolah.sch.id',
            'password' => Hash::make('password123'),
            'role' => 'guru',
        ]);

        // 2. Akun Siswa (Alwi Husein)
        User::create([
            'name' => 'Alwi Husein',
            'email' => 'siswa@sekolah.sch.id',
            'password' => Hash::make('password123'),
            'role' => 'siswa',
        ]);
    }
}