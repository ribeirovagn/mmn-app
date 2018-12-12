<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Enum;

/**
 * Description of BinarySideEnum
 *
 * @author vagner
 */
abstract class BinarySideEnum {
    const LEFT = 0;
    const RIGHT = 1;
    const AUTO = 2;
    
    const SIDE = [
        self::LEFT => 'LEFT',
        self::RIGHT => 'RIGHT',
        self::AUTO => 'AUTO'
    ];
}
