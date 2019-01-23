<?php

use Illuminate\Database\Seeder;
use App\Http\Enum\SysWithdrawTypeEnum;
use App\SysWithdrawType;

class SysWithdrawTypeTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SysWithdrawType::create([
            'id' => SysWithdrawTypeEnum::PLATAFORM,
            'name' => SysWithdrawTypeEnum::TYPE[SysWithdrawTypeEnum::PLATAFORM]
        ]);
        
        SysWithdrawType::create([
            'id' => SysWithdrawTypeEnum::CLIENT,
            'name' => SysWithdrawTypeEnum::TYPE[SysWithdrawTypeEnum::CLIENT]
        ]);
    }
}
