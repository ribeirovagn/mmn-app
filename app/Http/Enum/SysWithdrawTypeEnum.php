<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Enum;

/**
 * Description of SysWithdrawTypeEnum
 *
 * @author vagner
 */
abstract class SysWithdrawTypeEnum {
    const PLATAFORM = 1;
    const CLIENT = 2;
    
    const TYPE = [
        self::PLATAFORM => 'PLATAFORM',
        self::CLIENT => 'BANK'
    ];
}
