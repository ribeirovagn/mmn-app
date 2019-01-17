<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Enum;

/**
 * Description of SysBinaryType
 *
 * @author vagner
 */
abstract class SysBinaryTypeEnum {
    
    const MAIN = 1;
    const QUOTES = 2;
    
    const TYPES = [
        self::MAIN => "MAIN",
        self::QUOTES => "QUOTES"
    ];

}