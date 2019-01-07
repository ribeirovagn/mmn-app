<?php

use Illuminate\Database\Seeder;
use App\SysUserStatus;
use App\Http\Enum\UserStatusEnum;

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
            'id' => UserStatusEnum::INIT,
            'name' => UserStatusEnum::STATUS[UserStatusEnum::INIT]
        ]);
        SysUserStatus::create([
            'id' => UserStatusEnum::PENDING,
            'name' => UserStatusEnum::STATUS[UserStatusEnum::PENDING]
        ]);
        SysUserStatus::create([
            'id' => UserStatusEnum::ACTIVE,
            'name' => UserStatusEnum::STATUS[UserStatusEnum::ACTIVE]
        ]);
        SysUserStatus::create([
            'id' => UserStatusEnum::CANCELED,
            'name' => UserStatusEnum::STATUS[UserStatusEnum::CANCELED]
        ]);
    }
}