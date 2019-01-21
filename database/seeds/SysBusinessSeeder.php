<?php

use Illuminate\Database\Seeder;
use App\SysBusiness;

class SysBusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SysBusiness::create([
            'binary' => false,
            'unilevel' => true,
        ]);
    }
}
