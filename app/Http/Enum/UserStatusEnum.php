<?php


namespace App\Http\Enum;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserStatusEnum
 *
 * @author vagner
 */
abstract class UserStatusEnum {

    const INIT = 0;
    const PENDING = 1;
    const ACTIVE = 2;
    const CANCELED = 3;

    /***/
    const STATUS = [
        self::INIT => 'INIT',
        self::PENDING => 'PENDING',
        self::ACTIVE => 'ACTIVE',
        self::CANCELED => 'CANCELED',
    ];
}
