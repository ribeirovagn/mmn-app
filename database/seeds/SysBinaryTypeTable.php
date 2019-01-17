<?php

use Illuminate\Database\Seeder;
use App\Http\Enum\SysBinaryTypeEnum;
use App\SysBinaryType;

class SysBinaryTypeTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SysBinaryType::create([
            'id' => SysBinaryTypeEnum::MAIN,
            'name' => SysBinaryTypeEnum::TYPES[SysBinaryTypeEnum::MAIN]
        ]);
        
        SysBinaryType::create([
            'id' => SysBinaryTypeEnum::QUOTES,
            'name' => SysBinaryTypeEnum::TYPES[SysBinaryTypeEnum::QUOTES]
        ]);
    }
}
