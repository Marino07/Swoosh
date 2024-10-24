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
        $this->call([
            BasicSeeder::class,
            LanguageSeeder::class,
            LifestyleSeeder::class,
        ]);
        // User::factory(10)->create();

        //User::factory(10)->create([]);
    }
}
