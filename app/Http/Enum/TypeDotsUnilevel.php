<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Enum;

/**
 * Description of TypeDotsUnilevel
 *
 * @author vagner
 */
abstract class TypeDotsUnilevel {
    const BONUS = 1;
    const BINARY_CLOSURE  = 2;
    
    const TYPE = [
        self::BONUS => 'BONUS',
        self::BINARY_CLOSURE => 'BINARY CLOSURE'
    ];
}
