<?php
/**
 * Created by PhpStorm.
 * User: kieran.fahy
 * Date: 2/2/2018
 * Time: 1:01 PM
 */

namespace busRegistration\Http\PaymentGateway\Moneris\Classes;


##################### mpgRecur ##############################################

class mpgRecur{

    var $params;
    var $recurTemplate = array('recur_unit','start_now','start_date','num_recurs','period','recur_amount');

    function __construct($params)
    {
        $this->params = $params;
        if( (! $this->params['period']) )
        {
            $this->params['period'] = 1;
        }
    }

    function toXML()
    {
        $xmlString = "";

        foreach($this->recurTemplate as $tag)
        {
            $xmlString .= "<$tag>". $this->params[$tag] ."</$tag>";
        }

        return "<recur>$xmlString</recur>";
    }

}//end class