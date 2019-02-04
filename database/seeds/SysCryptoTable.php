<?php

use Illuminate\Database\Seeder;
use App\SysCrypto;

class SysCryptoTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SysCrypto::create([
            'name' => 'Bitcoin',
            'abbreviation' => 'BTC'
        ]);
    }
}
