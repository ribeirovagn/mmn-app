<?php

use Illuminate\Database\Seeder;
use App\SysTransactionsType;
use App\Http\Enum\TransactionsTypeEnum;

class SysTransactionsTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SysTransactionsType::create([
            'name' => TransactionsTypeEnum::TYPE[TransactionsTypeEnum::BONUS]
        ]);
        SysTransactionsType::create([
            'name' => TransactionsTypeEnum::TYPE[TransactionsTypeEnum::WITHDRAW]
        ]);
        SysTransactionsType::create([
            'name' => TransactionsTypeEnum::TYPE[TransactionsTypeEnum::WITHDRAW_TAX]
        ]);
        SysTransactionsType::create([
            'name' => TransactionsTypeEnum::TYPE[TransactionsTypeEnum::REVERSAL]
        ]);
        SysTransactionsType::create([
            'name' => TransactionsTypeEnum::TYPE[TransactionsTypeEnum::PAYMENT]
        ]);
    }
}
