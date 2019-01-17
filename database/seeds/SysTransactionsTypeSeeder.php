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
            'id' => TransactionsTypeEnum::BONUS,
            'name' => TransactionsTypeEnum::TYPE[TransactionsTypeEnum::BONUS]
        ]);
        SysTransactionsType::create([
            'id' => TransactionsTypeEnum::WITHDRAW,
            'name' => TransactionsTypeEnum::TYPE[TransactionsTypeEnum::WITHDRAW]
        ]);
        SysTransactionsType::create([
            'id' => TransactionsTypeEnum::WITHDRAW_TAX,
            'name' => TransactionsTypeEnum::TYPE[TransactionsTypeEnum::WITHDRAW_TAX]
        ]);
        SysTransactionsType::create([
            'id' => TransactionsTypeEnum::REVERSAL,
            'name' => TransactionsTypeEnum::TYPE[TransactionsTypeEnum::REVERSAL]
        ]);
        SysTransactionsType::create([
            'id' => TransactionsTypeEnum::PAYMENT,
            'name' => TransactionsTypeEnum::TYPE[TransactionsTypeEnum::PAYMENT]
        ]);
        SysTransactionsType::create([
            'id' => TransactionsTypeEnum::BINARY_CLOSURE,
            'name' => TransactionsTypeEnum::TYPE[TransactionsTypeEnum::BINARY_CLOSURE]
        ]);
    }
}
