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
            'name' => 'Pending'
        ]);
        
        SysUserStatus::create([
            'name' => 'Active'
        ]);
        
        SysUserStatus::create([
            'name' => 'Canceled'
        ]);
        
    }
}