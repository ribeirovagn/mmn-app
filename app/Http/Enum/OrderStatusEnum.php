<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Enum;

/**
 * Description of OrderStatusEnum
 *
 * @author vagner
 */
abstract class OrderStatusEnum {
    const PENDING = 1;
    const CANCELED = 2;
    const EXPIRED = 3;
    const PAID = 4;
    
    const STATUS = [
        self::PENDING => 'PENDING',
        self::CANCELED => 'CANCELED',
        self::EXPIRED => 'EXPIRED',
        self::PAID => 'PAID',
    ];
}
