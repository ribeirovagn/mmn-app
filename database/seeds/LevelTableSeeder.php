<?php

use Illuminate\Database\Seeder;
use App\Level;
use App\LevelStatus;
use App\SysUserStatus;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        SysUserStatus::create([
            'name' => 'Pendente'
        ]);
        $ativo = SysUserStatus::create([
            'name' => 'Ativo'
        ]);
        SysUserStatus::create([
            'name' => 'Cancelado'
        ]);        
        
        
        $level1 = Level::create([
            'bonus_id' => 4,
            'product_id' => 2,
            'dots_binary' => 30,
            'dots_unilevel' => 30,
            'start' => 1,
            'end' => 2,
            'amount' => 15
        ]);
        
        LevelStatus::create([
            'level_id' => $level1->id,
            'sys_user_status_id' => $ativo->id
        ]);
        
        $level2 = Level::create([
            'bonus_id' => 4,
            'product_id' => 3,
            'dots_binary' => 30,
            'dots_unilevel' => 30,
            'start' => 1,
            'end' => 2,
            'amount' => 15
        ]);
        
        LevelStatus::create([
            'level_id' => $level1->id,
            'sys_user_status_id' => $ativo->id
        ]);
        
        $level3 = Level::create([
            'bonus_id' => 4,
            'product_id' => 3,
            'dots_binary' => 30,
            'dots_unilevel' => 30,
            'start' => 3,
            'end' => 5,
            'amount' => 10
        ]);
        
        LevelStatus::create([
            'level_id' => $level1->id,
            'sys_user_status_id' => $ativo->id
        ]);
        
    }
}
