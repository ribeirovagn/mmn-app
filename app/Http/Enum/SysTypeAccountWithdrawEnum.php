<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Enum;

/**
 * Description of SysTypeAccountWithdraw
 *
 * @author vagner
 */
abstract class SysTypeAccountWithdrawEnum {
    const ADDRESS_CRYPTO = 1;
    const BANK_ACCOUNT = 2;
    const PLATAFORM = 3;
    
    const TYPE = [
        self::ADDRESS_CRYPTO => 'ADDRESS CRYPTO',
        self::BANK_ACCOUNT => 'BANK ACCOUNT',
        self::PLATAFORM => 'PLATAFORM'
    ];
}
