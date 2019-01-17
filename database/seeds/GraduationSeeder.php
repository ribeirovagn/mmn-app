<?php

use Illuminate\Database\Seeder;
use App\Graduation;

class GraduationSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Graduation::create([
            'name' => 'Beginner',
            'ordinal' => 1,
            'limit' => 99999,
            'dots_start' => 0,
            'dots_end' => 49
        ]);
        
        Graduation::create([
            'name' => 'Silver',
            'ordinal' => 2,
            'limit' => 99999,
            'dots_start' => 50,
            'dots_end' => 99
        ]);
        
        Graduation::create([
            'name' => 'Gold',
            'ordinal' => 3,
            'limit' => 99999,
            'dots_start' => 100,
            'dots_end' => 149
        ]);
        
        Graduation::create([
            'name' => 'Emerald',
            'ordinal' => 4,
            'limit' => 99999,
            'dots_start' => 150,
            'dots_end' => 199
        ]);
        
        Graduation::create([
            'name' => 'Sapphire',
            'ordinal' => 5,
            'limit' => 99999,
            'dots_start' => 200,
            'dots_end' => 249
        ]);
        
        Graduation::create([
            'name' => 'Diamond',
            'ordinal' => 6,
            'limit' => 99999,
            'dots_start' => 250,
            'dots_end' => 299
        ]);
    }

}