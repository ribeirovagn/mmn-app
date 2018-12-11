<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Enum;

/**
 *
 * Description of TransactionsTypeEnum
 *
 * @author vagner
 */
abstract class TransactionsTypeEnum {
    const BONUS = 1;
    const WITHDRAW = 2;
    const REVERSAL = 3;
    const PAYMENT = 4;
    
    const TYPE = [
        self::BONUS => 'BONUS',
        self::WITHDRAW => 'WITHDRAW',
        self::REVERSAL => 'REVERSAL',
        self::PAYMENT => 'PAYMENT',
    ];
}
