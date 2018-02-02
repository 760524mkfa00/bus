<?php
/**
 * Created by PhpStorm.
 * User: kieran.fahy
 * Date: 2/2/2018
 * Time: 1:04 PM
 */

namespace busRegistration\Http\PaymentGateway\Moneris\Classes;


###################### MpiHttpsPost #########################################

class MpiHttpsPost
{

    var $api_token;
    var $store_id;
    var $mpiRequest;
    var $mpiResponse;

    function __construct($storeid,$apitoken,$mpiRequestOBJ)
    {

        $this->store_id=$storeid;
        $this->api_token= $apitoken;
        $this->mpiRequest=$mpiRequestOBJ;
        $dataToSend=$this->toXML();

        $url = $this->mpiRequest->getURL();

        $httpsPost= new httpsPost();
        $httpsPost->httpsPost($url, $dataToSend);
        $response = $httpsPost->getHttpsResponse();

        if(!$response)
        {

            $response="<?xml version=\"1.0\"?>".
                "<MpiResponse>".
                "<type>null</type>".
                "<success>false</success>".
                "<message>null</message>".
                "<PaReq>null</PaReq>".
                "<TermUrl>null</TermUrl>".
                "<MD>null</MD>".
                "<ACSUrl>null</ACSUrl>".
                "<cavv>null</cavv>".
                "<PAResVerified>null</PAResVerified>".
                "</MpiResponse>";
        }

        $this->mpiResponse=new MpiResponse();
        $this->mpiResponse->MpiResponse($response);

    }



    function getMpiResponse()
    {
        return $this->mpiResponse;

    }

    function toXML( )
    {

        $req=$this->mpiRequest ;
        $reqXMLString=$req->toXML();

        $xmlString ="<?xml version=\"1.0\"?>".
            "<MpiRequest>".
            "<store_id>$this->store_id</store_id>".
            "<api_token>$this->api_token</api_token>".
            $reqXMLString.
            "</MpiRequest>";

        return ($xmlString);

    }

}//end class mpiHttpsPost