<?php


namespace busRegistration\Http\PaymentGateway\moneris;

use busRegistration\Order;

class paymentActions
{

    protected $store_id;

    protected $api_token;


    public function __construct()
    {

        $this->store_id = env('MONERIS_ID');

        $this->api_token = env('MONERIS_KEY');
    }

    public function pay($details, Order $order)
    {

        /************************* Transactional Variables ****************************/

        $type = 'purchase';
        $cust_id = $details['custNumber'];
        $order_id = $details['orderNumber'];
        $amount = $details['amount'];
        $pan = $details['pan'];
        $expiry_date = $details['expdate'];
        $crypt = '7';

        /******************* Customer Information Variables ********************/

        $number = $details['billing_address_number'];
        $street = $details['billing_address_street'];
        $postal_code = $details['billing_postal_code'];

        /**************************** CVD Variables ****************************/

        $cvd_indicator = '1';
        $cvd_value = $details['cvc'];

        /*********************** Transactional Associative Array **********************/

        $txnArray = array('type' => $type,
            'order_id' => $order_id,
            'cust_id' => $cust_id,
            'amount' => $amount,
            'pan' => $pan,
            'expdate' => $expiry_date,
            'crypt_type' => $crypt
        );

        /********************** AVS Associative Array *************************/

        $avsTemplate = array(
            'avs_street_number' => $number,
            'avs_street_name' => $street,
            'avs_zipcode' => $postal_code
        );

        /********************** CVD Associative Array *************************/

        $cvdTemplate = array(
            'cvd_indicator' => $cvd_indicator,
            'cvd_value' => $cvd_value
        );

        /************************** AVS Object ********************************/

        $mpgAvsInfo = new mpgAvsInfo ();
        $mpgAvsInfo->mpgAvsInfo($avsTemplate);

        /************************** CVD Object ********************************/

        $mpgCvdInfo = new mpgCvdInfo();
        $mpgCvdInfo->mpgCvdInfo($cvdTemplate);


        /**************************** Transaction Object *****************************/

        $mpgTxn = new mpgTransaction();
        $mpgTxn->mpgTransaction($txnArray);
        $mpgTxn->setAvsInfo($mpgAvsInfo);
        $mpgTxn->setCvdInfo($mpgCvdInfo);
        /****************************** Request Object *******************************/

        $mpgRequest = new mpgRequest();
        $mpgRequest->mpgRequest($mpgTxn);
        $mpgRequest->setProcCountryCode("CA"); //"US" for sending transaction to US environment
        $mpgRequest->setTestMode(true); //false or comment out this line for production transactions

        /***************************** HTTPS Post Object *****************************/

        /* Status Check Example
        $mpgHttpPost  =new mpgHttpsPostStatus($store_id,$api_token,$status_check,$mpgRequest);
        */

        $mpgHttpPost = new mpgHttpsPost();
        $mpgHttpPost->mpgHttpsPost('store5', 'yesguy', $mpgRequest);
//        $mpgHttpPost->mpgHttpsPost($this->store_id,$this->api_token,$mpgRequest);

        /******************************* Response ************************************/
        $mpgResponse = $mpgHttpPost->getMpgResponse();

        if ( (int) $mpgResponse->getStatusCode() >= 50) {
            return back()->withErrors($mpgResponse->getMessage());
        }

        $order->update([
            'paid_amount' => $mpgResponse->getTransAmount(),
            'reference_number' => $mpgResponse->getReferenceNum(),
            'transaction_number' => $mpgResponse->getTxnNumber(),
            'card_type' => $mpgResponse->getCardType(),
            'message' =>$mpgResponse->getMessage(),
            'auth_code' => $mpgResponse->getAuthCode(),
            'transaction_date' => $mpgResponse->getTransDate()
        ]);



//        print("\nCardType = " . $mpgResponse->getCardType());
//        echo '<br />';print("\nTransAmount = " . $mpgResponse->getTransAmount());
//        echo '<br />';print("\nTxnNumber = " . $mpgResponse->getTxnNumber());
//        echo '<br />';print("\nReceiptId = " . $mpgResponse->getReceiptId());
//        echo '<br />';print("\nTransType = " . $mpgResponse->getTransType());
//        echo '<br />';print("\nReferenceNum = " . $mpgResponse->getReferenceNum());
//        echo '<br />';print("\nResponseCode = " . $mpgResponse->getResponseCode());
//        echo '<br />';print("\nISO = " . $mpgResponse->getISO());
//        echo '<br />';print("\nMessage = " . $mpgResponse->getMessage());
//        echo '<br />';print("\nIsVisaDebit = " . $mpgResponse->getIsVisaDebit());
//        echo '<br />';print("\nAuthCode = " . $mpgResponse->getAuthCode());
//        echo '<br />';print("\nComplete = " . $mpgResponse->getComplete());
//        echo '<br />';print("\nTransDate = " . $mpgResponse->getTransDate());
//        echo '<br />';print("\nTransTime = " . $mpgResponse->getTransTime());
//        echo '<br />';print("\nTicket = " . $mpgResponse->getTicket());
//        echo '<br />';print("\nTimedOut = " . $mpgResponse->getTimedOut());
//        echo '<br />';print("\nStatusCode = " . $mpgResponse->getStatusCode());
//        echo '<br />';print("\nStatusMessage = " . $mpgResponse->getStatusMessage());
//        echo '<br />';print("\nMCPAmount = " . $mpgResponse->getMCPAmount());
//        echo '<br />';print("\nMCPCurrenyCode = " . $mpgResponse->getMCPCurrencyCode());


    }


    public function recurringPayment($details, $noMonths)
    {

    }

    public function refund($details)
    {

    }

    public function recurringTerminate($orderID)
    {

    }





}