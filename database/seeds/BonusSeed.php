<?php

use Illuminate\Database\Seeder;
use App\Bonus;

class BonusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bonus::create([
            'name' => 'Indicação Direta'
        ]);
        Bonus::create([
            'name' => 'Mineração Fracionada'
        ]);
        Bonus::create([
            'name' => 'Multi-Nível'
        ]);
        Bonus::create([
            'name' => 'Venda direta'
        ]);
        Bonus::create([
            'name' => 'Renovação de Rede'
        ]);
        Bonus::create([
            'name' => 'Plano de Carreira'
        ]);
    }
}
