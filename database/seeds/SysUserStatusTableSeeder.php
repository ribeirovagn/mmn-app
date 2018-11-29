<?php

use Illuminate\Database\Seeder;
use App\SysUserStatus;

class SysUserStatusTableSeeder extends Seeder
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
        
        SysUserStatus::create([
            'name' => 'Ativo'
        ]);
        
        SysUserStatus::create([
            'name' => 'Cancelado'
        ]);
        
    }
}
