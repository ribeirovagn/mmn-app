<?php

use Illuminate\Database\Seeder;
use App\Bonus;
use App\Http\Enum\FixedBonusEnum;

class BonusSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bonus::create([
            'id' => FixedBonusEnum::DIRECT_SALE,
            'name' => FixedBonusEnum::BONUS[FixedBonusEnum::DIRECT_SALE],
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam nec varius justo, sed rhoncus nulla. Phasellus efficitur semper odio sit amet volutpat'
        ]);
        Bonus::create([
            'id' => FixedBonusEnum::DIRECT_INDICATION,
            'name' => FixedBonusEnum::BONUS[FixedBonusEnum::DIRECT_INDICATION],
            'description' => 'Pellentesque at mauris mollis tellus feugiat volutpat id at nibh. Vestibulum facilisis dictum feugiat. Vestibulum bibendum orci sed consequat lacinia. Cras sollicitudin viverra orci, nec euismod augue pharetra sit amet. Maecenas felis odio, molestie sit amet neque sed, aliquam tristique erat. Morbi tristique purus id ligula sodales consectetur. Aenean ut lobortis felis.'
        ]);
        Bonus::create([
            'id' => FixedBonusEnum::BINARY_CLOSURE,
            'name' => FixedBonusEnum::BONUS[FixedBonusEnum::BINARY_CLOSURE],
            'description' => 'Etiam blandit tempor bibendum. Vivamus et mauris mi. Duis lacinia lorem ac eleifend dictum. Phasellus ac posuere mi. Fusce aliquet eros et vulputate placerat. Integer egestas ligula urna, non auctor orci fermentum sit amet. Morbi egestas nibh non ante vehicula cursus. Maecenas sagittis at mauris in ornare. Nunc posuere imperdiet odio eu gravida. Phasellus nisi nisi, molestie in mauris eu, fermentum aliquet ex.'
        ]);
    }
}
