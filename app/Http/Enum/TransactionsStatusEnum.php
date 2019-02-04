<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Enum;

/**
 * Description of TransactionsStatusEnum
 *
 * @author vagner
 */
abstract class TransactionsStatusEnum {
    const PENDING = 1;
    const PROCESSING = 2;
    const COMPLETED = 3;
    const SUCCESS = 4;
    const CANCELED = 5;
    const REVERSAL = 6;
    
    const STATUS = [
        self::PENDING => 'PENDING',
        self::PROCESSING => 'PROCESSING',
        self::COMPLETED => 'COMPLETED',
        self::SUCCESS => 'SUCCESS',
        self::CANCELED => 'CANCELED',
        self::REVERSAL => 'REVERSAL',
    ];
}
