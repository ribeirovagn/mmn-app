<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Enum;

/**
 * Description of ConfigBinaryEnum
 *
 * @author vagner
 */
abstract class ConfigBinaryEnum {

    const EVERY_MINUTE = 1;
    const EVERY_THIRTEEN_MINUTES = 2;
    const HOURLY = 3;
    const DAILY_AT = 4;
    const WEEKLY_ON = 5;
    const MOUNTHLY_ON = 6;
    
    const SCHEDULY = [
        self::EVERY_MINUTE => [
            'name' => 'EVERY MINUTE'
        ],
        self::EVERY_THIRTEEN_MINUTES => [
            'name' => 'EVERY THIRTEEN MINUTES'
        ],
        self::HOURLY => [
            'name' => 'HOURLY',
        ],
        self::DAILY_AT => [
            'name' => 'DAILY AT',
            'time' => [
                'hour' => null
            ]
        ],
        self::WEEKLY_ON => [
            'name' => 'WEEKLY ON',
            'time' => [
                'day' => null,
                'hour' => null
            ]
        ],
        self::MOUNTHLY_ON => [
            'name' => 'MOUNTHLY ON',
            'time' => [
                'day' => null
            ]            
        ]
    ];

}
