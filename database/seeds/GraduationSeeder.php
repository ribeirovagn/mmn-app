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
    }

}