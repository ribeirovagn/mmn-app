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
            'dots_end' => 499
        ]);
        
        Graduation::create([
            'name' => 'Silver',
            'ordinal' => 2,
            'limit' => 99999,
            'dots_start' => 500,
            'dots_end' => 999
        ]);
        
        Graduation::create([
            'name' => 'Gold',
            'ordinal' => 3,
            'limit' => 99999,
            'dots_start' => 1000,
            'dots_end' => 1499
        ]);
        
        Graduation::create([
            'name' => 'Emerald',
            'ordinal' => 4,
            'limit' => 99999,
            'dots_start' => 1500,
            'dots_end' => 1999
        ]);
        
        Graduation::create([
            'name' => 'Sapphire',
            'ordinal' => 5,
            'limit' => 99999,
            'dots_start' => 2000,
            'dots_end' => 2499
        ]);
        
        Graduation::create([
            'name' => 'Diamond',
            'ordinal' => 6,
            'limit' => 99999,
            'dots_start' => 2500,
            'dots_end' => 2999
        ]);
    }

}