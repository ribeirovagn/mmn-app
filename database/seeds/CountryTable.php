<?php

use Illuminate\Database\Seeder;
use App\Country;

class CountryTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'name' => 'Brasil',
            'abbreviation' => 'BR'
        ]);
    }
}
