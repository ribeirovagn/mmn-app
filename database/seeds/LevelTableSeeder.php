<?php

use Illuminate\Database\Seeder;
use App\Level;
use App\LevelStatus;
use App\SysUserStatus;
use App\Http\Enum\UserStatusEnum;
use App\Http\Enum\LevelTypeEnum;


class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        
        $level1 = Level::create([
            'bonus_id' => 4,
            'product_id' => 2,
            'dots' => 30,
            'type' => LevelTypeEnum::BINARY,
            'start' => 1,
            'end' => 2,
            'amount' => 15
        ]);
        
        LevelStatus::create([
            'level_id' => $level1->id,
            'sys_user_status_id' => UserStatusEnum::ACTIVE
        ]);
        
        $level2 = Level::create([
            'bonus_id' => 4,
            'product_id' => 3,
            'dots' => 30,
            'type' => LevelTypeEnum::UNILEVEL,
            'start' => 1,
            'end' => 2,
            'amount' => 15
        ]);
        
        LevelStatus::create([
            'level_id' => $level2->id,
            'sys_user_status_id' => UserStatusEnum::ACTIVE
        ]);
        
        $level3 = Level::create([
            'bonus_id' => 4,
            'product_id' => 3,
            'dots' => 30,
            'type' => LevelTypeEnum::UNILEVEL,
            'start' => 3,
            'end' => 5,
            'amount' => 10
        ]);
        
        LevelStatus::create([
            'level_id' => $level3->id,
            'sys_user_status_id' => UserStatusEnum::ACTIVE
        ]);
        
    }
}
