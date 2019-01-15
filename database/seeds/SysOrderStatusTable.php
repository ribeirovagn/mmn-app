<?php

use Illuminate\Database\Seeder;
use App\SysOrderStatus;
use App\Http\Enum\OrderStatusEnum;

class SysOrderStatusTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SysOrderStatus::create([
            'id' => OrderStatusEnum::PENDING,
            'name' => OrderStatusEnum::STATUS[OrderStatusEnum::PENDING]
        ]);
        SysOrderStatus::create([
            'id' => OrderStatusEnum::CANCELED,
            'name' => OrderStatusEnum::STATUS[OrderStatusEnum::CANCELED]
        ]);
        SysOrderStatus::create([
            'id' => OrderStatusEnum::EXPIRED,
            'name' => OrderStatusEnum::STATUS[OrderStatusEnum::EXPIRED]
        ]);
        SysOrderStatus::create([
            'id' => OrderStatusEnum::PAID,
            'name' => OrderStatusEnum::STATUS[OrderStatusEnum::PAID]
        ]);
    }
}
