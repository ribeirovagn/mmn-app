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
    const WITHDRAW_TAX = 3;
    const REVERSAL = 4;
    const PAYMENT = 5;
    const BINARY_CLOSURE = 6;
    
    const TYPE = [
        self::BONUS => 'BONUS',
        self::WITHDRAW => 'WITHDRAW',
        self::WITHDRAW_TAX => 'WITHDRAW TAX',
        self::REVERSAL => 'REVERSAL',
        self::PAYMENT => 'PAYMENT',
        self::BINARY_CLOSURE => 'BINARY CLOSURE',
    ];
}
