<?php

use Illuminate\Database\Seeder;
use App\SysPaymentType;
use App\Http\Enum\SysPaymentTypeEnum;


class SysPaymentTypeTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SysPaymentType::create([
            'id' => SysPaymentTypeEnum::WITHDRAW,
            'type' => SysPaymentTypeEnum::TYPES[SysPaymentTypeEnum::WITHDRAW]
        ]);
        
        SysPaymentType::create([
            'id' => SysPaymentTypeEnum::BITCOIN,
            'type' => SysPaymentTypeEnum::TYPES[SysPaymentTypeEnum::BITCOIN]
        ]);
    }
}
