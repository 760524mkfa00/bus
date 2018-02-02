<?php
/**
 * Created by PhpStorm.
 * User: kieran.fahy
 * Date: 2/2/2018
 * Time: 1:06 PM
 */

namespace busRegistration\Http\PaymentGateway\Moneris\Classes;


################# mpiTransaction ############################################

class MpiTransaction
{
    var $txn;

    function __construct($txn)
    {
        $this->txn=$txn;
    }

    function getTransaction()
    {
        return $this->txn;
    }
}//end class MpiTransaction