<?php

namespace Database\Seeders;

use App\Enums\BasicGroupEnum;
use App\Models\Basic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BasicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        #Children preference group
        Basic::create([
            'name' => 'i want children',
            'group' => BasicGroupEnum::children,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Basic::create([
            'name' => 'i don\'t want children',
            'group' => BasicGroupEnum::children,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        //...


         //Cleaner approach

         #Education level preference group
         $values= ['In College','Phd','Bachelors'];
         foreach ($values as $key => $value) {
            Basic::create([
                'name' => $value,
                'group' => BasicGroupEnum::education,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
         }

          #Zodiac Sign preference group
          $values= ['Taurus','Leo','Libra'];
          foreach ($values as $key => $value) {
             Basic::create([
                 'name' => $value,
                 'group' => BasicGroupEnum::zodiac,
                 'created_at' => now(),
                 'updated_at' => now(),
             ]);
          }

    }
}
