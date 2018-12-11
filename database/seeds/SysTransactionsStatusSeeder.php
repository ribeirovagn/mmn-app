<?php

use Illuminate\Database\Seeder;
use App\SysTransactionsStatus;
use App\Http\Enum\TransactionsStatusEnum;

class SysTransactionsStatusSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        SysTransactionsStatus::create([
            'name' => TransactionsStatusEnum::STATUS[TransactionsStatusEnum::PENDING]
        ]);

        SysTransactionsStatus::create([
            'name' => TransactionsStatusEnum::STATUS[TransactionsStatusEnum::COMPLETED]
        ]);

        SysTransactionsStatus::create([
            'name' => TransactionsStatusEnum::STATUS[TransactionsStatusEnum::SUCCESS]
        ]);

        SysTransactionsStatus::create([
            'name' => TransactionsStatusEnum::STATUS[TransactionsStatusEnum::CANCELED]
        ]);
    }

}
