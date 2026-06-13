<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user (safe to re-run)
        User::updateOrCreate(
            ['email' => 'admin@eduspace.com'],
            [
                'name' => 'Guru Admin',
                'password' => bcrypt('password'),
            ]
        );

        $this->call(DummyDataSeeder::class);
    }
}
