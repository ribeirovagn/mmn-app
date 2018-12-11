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
    const COMPLETED = 2;
    const SUCCESS = 3;
    const CANCELED = 4;
    
    const STATUS = [
        self::PENDING => 'PENDING',
        self::COMPLETED => 'COMPLETED',
        self::SUCCESS => 'SUCCESS',
        self::CANCELED => 'CANCELED',
    ];
}
