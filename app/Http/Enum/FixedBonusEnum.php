<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Enum;

/**
 * Description of FixedBonusEnum
 *
 * @author vagner
 */
abstract class FixedBonusEnum {
    const DIRECT_SALE = 1;
    const DIRECT_INDICATION = 2;
    const BINARY_CLOSURE = 3;
    
    const BONUS = [
        self::DIRECT_SALE => 'DIRECT SALE',
        self::DIRECT_INDICATION => 'DIRECT INDICATION',
        self::BINARY_CLOSURE => 'BINARY CLOSURE',
    ];
}
