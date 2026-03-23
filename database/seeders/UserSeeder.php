<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuario 1: Cliente
        User::create([
            'name' => 'Usuario Cliente',
            'email' => 'cliente@example.com',
            'password' => Hash::make('password'),
            'role' => 'client',
        ]);

        // Usuario 2: Administrador
        User::create([
            'name' => 'Usuario Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }
}
