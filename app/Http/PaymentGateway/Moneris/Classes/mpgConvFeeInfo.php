<?php
/**
 * Created by PhpStorm.
 * User: kieran.fahy
 * Date: 2/2/2018
 * Time: 1:03 PM
 */

namespace busRegistration\Http\PaymentGateway\Moneris\Classes;


##################### mpgConvFeeInfo ########################################

class mpgConvFeeInfo
{

    var $params;
    var $convFeeTemplate = array('convenience_fee');

    function __construct($params)
    {
        $this->params = $params;
    }

    function toXML()
    {
        $xmlString = "";

        foreach($this->convFeeTemplate as $tag)
        {
            $xmlString .= "<$tag>". $this->params[$tag] ."</$tag>";
        }

        return "<convfee_info>$xmlString</convfee_info>";
    }

}//end class