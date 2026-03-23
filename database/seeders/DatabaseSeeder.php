<?php

namespace Database\Seeders;

use Database\Seeders\BrandSeeder;
use Database\Seeders\CarSeeder;
use Database\Seeders\CategorySeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */

        $this->call([
            UserSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            CarSeeder::class,
            ReservationSeeder::class,
        ]);
    }
}
