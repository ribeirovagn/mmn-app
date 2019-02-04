<?php

use Illuminate\Database\Seeder;
use App\Http\Enum\SysTypeAccountWithdrawEnum;
use App\SysTypeAccountWithdraw;

class SysTypeAccountWithdrawTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SysTypeAccountWithdraw::create([
            'id' => SysTypeAccountWithdrawEnum::ADDRESS_CRYPTO,
            'name' => SysTypeAccountWithdrawEnum::TYPE[SysTypeAccountWithdrawEnum::ADDRESS_CRYPTO]
        ]);

        SysTypeAccountWithdraw::create([
            'id' => SysTypeAccountWithdrawEnum::BANK_ACCOUNT,
            'name' => SysTypeAccountWithdrawEnum::TYPE[SysTypeAccountWithdrawEnum::BANK_ACCOUNT]
        ]);

        SysTypeAccountWithdraw::create([
            'id' => SysTypeAccountWithdrawEnum::PLATAFORM,
            'name' => SysTypeAccountWithdrawEnum::TYPE[SysTypeAccountWithdrawEnum::PLATAFORM]
        ]);
    }
}
