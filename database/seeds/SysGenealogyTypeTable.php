<?php

use Illuminate\Database\Seeder;
use App\Http\Enum\LevelTypeEnum;
use App\SysGenealogyType;

class SysGenealogyTypeTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SysGenealogyType::create([
            'id' => LevelTypeEnum::BINARY,
            'name' => LevelTypeEnum::TYPE[LevelTypeEnum::BINARY]
        ]);
        SysGenealogyType::create([
            'id' => LevelTypeEnum::UNILEVEL,
            'name' => LevelTypeEnum::TYPE[LevelTypeEnum::UNILEVEL]
        ]);
    }
}
