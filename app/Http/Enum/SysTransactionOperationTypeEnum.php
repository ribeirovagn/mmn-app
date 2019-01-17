<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Enum;

/**
 * Description of SysTransactionOperationType
 *
 * @author vagner
 */
abstract class SysTransactionOperationTypeEnum {
    const DEBIT = 1;
    const CREDIT = 2;
    
    const TYPE = [
        self::DEBIT => 'DEBIT',
        self::CREDIT => 'CREDIT'
    ];
    
   
}
