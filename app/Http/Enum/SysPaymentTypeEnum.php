<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Enum;

/**
 * Description of SysPaymentTypeEnum
 *
 * @author vagner
 */
abstract class SysPaymentTypeEnum {
    const WITHDRAW = 1;
    const BITCOIN = 2;
    
    
    const TYPES = [
        self::WITHDRAW => 'WITHDRAW',
        self::BITCOIN => 'BITCOIN'
    ];
}
