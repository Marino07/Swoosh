<?php

namespace Database\Seeders;

use App\Models\Lifestyle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LifestyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lifestyles = ['Gym','Non Smoker','Travel'];
        foreach($lifestyles as $key => $lifestyle){
            Lifestyle::create([
                'name' => $lifestyle,
            ]);
        }

    }
}
