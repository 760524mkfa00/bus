<?php
/**
 * Created by PhpStorm.
 * User: kieran.fahy
 * Date: 2/2/2018
 * Time: 12:57 PM
 */

namespace busRegistration\Http\PaymentGateway\Moneris\Classes;


###################### curlPost #############################################
class httpsPost
{
    var $url;
    var $dataToSend;
    var $clientTimeOut;
    var $apiVersion;
    var $response;
    var $debug = FALSE; //default is false for production release

    function __construct($url, $dataToSend)
    {
        $this->url=$url;
        $this->dataToSend=$dataToSend;

        if($this->debug == true)
        {
            echo "DataToSend= ".$this->dataToSend;
            echo "\n\nPostURL= " . $this->url;
        }


        $g=new mpgGlobals();
        $gArray=$g->getGlobals();
        $clientTimeOut = $gArray['CLIENT_TIMEOUT'];
        $apiVersion = $gArray['API_VERSION'];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt ($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$this->dataToSend);
        curl_setopt($ch,CURLOPT_TIMEOUT,$clientTimeOut);
        curl_setopt($ch,CURLOPT_USERAGENT,$apiVersion);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        //curl_setopt($ch, CURLOPT_CAINFO, "PATH_TO_CA_BUNDLE");
        $this->response=curl_exec($ch);

        curl_close($ch);

        if($this->debug == true)
        {
            echo "\n\nRESPONSE= $this->response\n";
        }

    }

    function getHttpsResponse()
    {
        return $this->response;
    }
}