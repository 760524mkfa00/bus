<?php
/**
 * Created by PhpStorm.
 * User: kieran.fahy
 * Date: 2/2/2018
 * Time: 1:03 PM
 */

namespace busRegistration\Http\PaymentGateway\Moneris\Classes;


##################### mpgTransaction ########################################

class mpgTransaction
{

    var $txn;
    var $custInfo = null;
    var $recur = null;
    var $cvd = null;
    var $avs = null;
    var $convFee = null;
    var $ach = null;
    var $sessionAccountInfo = null;
    var $attributeAccountInfo = null;
    var $level23Data = null;

    function __construct($txn)
    {
        $this->txn=$txn;
    }

    function getCustInfo()
    {
        return $this->custInfo;
    }

    function setCustInfo($custInfo)
    {
        $this->custInfo = $custInfo;
        array_push($this->txn,$custInfo);
    }

    function getRecur()
    {
        return $this->recur;
    }

    function setRecur($recur)
    {
        $this->recur = $recur;
    }

    function getTransaction()
    {
        return $this->txn;
    }

    function getCvdInfo()
    {
        return $this->cvd;
    }

    function setCvdInfo($cvd)
    {
        $this->cvd = $cvd;
    }

    function getAvsInfo()
    {
        return $this->avs;
    }

    function setAvsInfo($avs)
    {
        $this->avs = $avs;
    }

    function getAchInfo()
    {
        return $this->ach;
    }

    function setAchInfo($ach)
    {
        $this->ach = $ach;
    }

    function setConvFeeInfo($convFee)
    {
        $this->convFee = $convFee;
    }

    function getConvFeeInfo()
    {
        return $this->convFee;
    }

    function setExpiryDate($expdate)
    {
        $this->expdate = $expdate;
    }

    function getExpiryDate()
    {
        return $this->expdate;
    }

    function getAttributeAccountInfo()
    {
        return $this->attributeAccountInfo;
    }

    function setAttributeAccountInfo($attributeAccountInfo)
    {
        $this->attributeAccountInfo = $attributeAccountInfo;
    }

    function getSessionAccountInfo()
    {
        return $this->sessionAccountInfo;
    }

    function setSessionAccountInfo($sessionAccountInfo)
    {
        $this->sessionAccountInfo = $sessionAccountInfo;
    }

    function setLevel23Data($level23Object)
    {
        $this->level23Data = $level23Object;
    }

    function getLevel23Data()
    {
        return $this->level23Data;
    }

}//end class mpgTransaction