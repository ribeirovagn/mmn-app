<?php

use Illuminate\Database\Seeder;
use App\SysTransactionOperationType;
use App\Http\Enum\SysTransactionOperationTypeEnum;

class SysTransactionOperationTypeTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SysTransactionOperationType::create([
            'id' => SysTransactionOperationTypeEnum::DEBIT,
            'name' => SysTransactionOperationTypeEnum::TYPE[SysTransactionOperationTypeEnum::DEBIT]
        ]);
        
        SysTransactionOperationType::create([
            'id' => SysTransactionOperationTypeEnum::CREDIT,
            'name' => SysTransactionOperationTypeEnum::TYPE[SysTransactionOperationTypeEnum::CREDIT]
        ]);
    }
}
