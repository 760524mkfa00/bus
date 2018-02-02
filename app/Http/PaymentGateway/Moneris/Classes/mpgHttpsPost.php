<?php
/**
 * Created by PhpStorm.
 * User: kieran.fahy
 * Date: 2/2/2018
 * Time: 12:58 PM
 */

namespace busRegistration\Http\PaymentGateway\Moneris\Classes;


###################### mpgHttpsPost #########################################

class mpgHttpsPost
{

    var $api_token;
    var $store_id;
    var $app_version;
    var $mpgRequest;
    var $mpgResponse;
    var $xmlString;
    var $txnType;
    var $isMPI;

    function __construct($storeid,$apitoken,$mpgRequestOBJ)
    {

        $this->store_id=$storeid;
        $this->api_token= $apitoken;
        $this->app_version = null;
        $this->mpgRequest=$mpgRequestOBJ;
        $this->isMPI=$mpgRequestOBJ->getIsMPI();
        $dataToSend=$this->toXML();

        $url = $this->mpgRequest->getURL();

        $httpsPost = new httpsPost();
        $httpsPost->httpsPost($url, $dataToSend);
        $response = $httpsPost->getHttpsResponse();

        if(!$response)
        {

            $response="<?xml version=\"1.0\"?><response><receipt>".
                "<ReceiptId>Global Error Receipt</ReceiptId>".
                "<ReferenceNum>null</ReferenceNum><ResponseCode>null</ResponseCode>".
                "<AuthCode>null</AuthCode><TransTime>null</TransTime>".
                "<TransDate>null</TransDate><TransType>null</TransType><Complete>false</Complete>".
                "<Message>Global Error Receipt</Message><TransAmount>null</TransAmount>".
                "<CardType>null</CardType>".
                "<TransID>null</TransID><TimedOut>null</TimedOut>".
                "<CorporateCard>false</CorporateCard><MessageId>null</MessageId>".
                "</receipt></response>";
        }

        $this->mpgResponse = new mpgResponse();
        $this->mpgResponse->mpgResponse($response);

    }

    function setAppVersion($app_version)
    {
        $this->app_version = $app_version;
    }

    function getMpgResponse()
    {
        return $this->mpgResponse;

    }

    function toXML()
    {

        $req=$this->mpgRequest;
        $reqXMLString=$req->toXML();

        if($this->isMPI === true)
        {
            $this->xmlString .="<?xml version=\"1.0\"?>".
                "<MpiRequest>".
                "<store_id>$this->store_id</store_id>".
                "<api_token>$this->api_token</api_token>";

            if($this->app_version != null)
            {
                $this->xmlString .= "<app_version>$this->app_version</app_version>";
            }

            $this->xmlString .= 	$reqXMLString.
                "</MpiRequest>";
        }
        else
        {
            $this->xmlString .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>".
                "<request>".
                "<store_id>$this->store_id</store_id>".
                "<api_token>$this->api_token</api_token>";

            if($this->app_version != null)
            {
                $this->xmlString .= "<app_version>$this->app_version</app_version>";
            }

            $this->xmlString .=    	$reqXMLString.
                "</request>";
        }

        return ($this->xmlString);

    }

}//end class mpgHttpsPost