<?php

namespace Database\Seeders;

use App\Models\User;
use Heritage\Database\Console\Seeds\WithoutModelEvents;
use Heritage\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Invoke application modular domain seeder
        $this->call(AppSeeder::class);

        // Seed default development user
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => bcrypt('password')]
        );
    }
}
