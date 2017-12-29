<?php

namespace busRegistration\Http\Controllers\Admin;


use busRegistration\Http\PaymentGateway\mpgHttpsPost;
use busRegistration\Http\PaymentGateway\mpgRequest;
use busRegistration\Http\PaymentGateway\mpgTransaction;
use busRegistration\User;
use busRegistration\Order;
use Illuminate\Http\Request;
use busRegistration\Http\Controllers\Controller;

class PaymentController extends Controller
{

    protected $store_id;

    protected $api_token;


    public function __construct()
    {

        $this->middleware('auth');

        $this->store_id = env('MONERIS_ID');

        $this->api_token = env('MONERIS_KEY');
    }

    public function index(Order $order)
    {

        $parent = User::where('id', $order->parent_id)->first();
        $ordering = $order->where('id', $order->id)->with('children')->first();

        return view('payments.details')
            ->withParent($parent)
            ->withOrder($ordering);
    }

    public function preAuthPayment(Request $request, Order $order)
    {


//        $details = $request->all();
//
//        $details['expdate'] = preg_replace('/[^0-9]/', '', $details['expdate']);

        /**************************** Request Variables *******************************/

        $store_id='store5';
        $api_token='yesguy';

        /************************* Transactional Variables ****************************/

        $type='purchase';
        $cust_id='cust id';
        $order_id='ord-'.date("dmy-G:i:s");
        $amount='1.00';
        $pan='4242424242424242';
        $expiry_date='2011';
        $crypt='7';
        $dynamic_descriptor='123';
        $status_check = 'false';

//Optional - Set for Multi-Currency only
//$amount must be 0.00 when using multi-currency
        $mcp_amount = '500'; //penny value amount 1.25 = 125
        $mcp_currency_code = '840'; //ISO-4217 country currency number

        /*********************** Transactional Associative Array **********************/

        $txnArray=array('type'=>$type,
            'order_id'=>$order_id,
            'cust_id'=>$cust_id,
            'amount'=>$amount,
            'pan'=>$pan,
            'expdate'=>$expiry_date,
            'crypt_type'=>$crypt,
            'dynamic_descriptor'=>$dynamic_descriptor
            //,'wallet_indicator' => '' //Refer to documentation for details
            //,'mcp_amount' => $mcp_amount,
            //'mcp_currency_code' => $mcp_currency_code
        );

        /**************************** Transaction Object *****************************/

        $mpgTxn = new mpgTransaction();
        $mpgTxn->mpgTransaction($txnArray);

        /****************************** Request Object *******************************/

        $mpgRequest = new mpgRequest();
        $mpgRequest->mpgRequest($mpgTxn);
        $mpgRequest->setProcCountryCode("CA"); //"US" for sending transaction to US environment
        $mpgRequest->setTestMode(true); //false or comment out this line for production transactions

        /***************************** HTTPS Post Object *****************************/

        /* Status Check Example
        $mpgHttpPost  =new mpgHttpsPostStatus($store_id,$api_token,$status_check,$mpgRequest);
        */

        $mpgHttpPost  =new mpgHttpsPost();
        $mpgHttpPost->mpgHttpsPost($store_id,$api_token,$mpgRequest);

        /******************************* Response ************************************/
        $mpgResponse=$mpgHttpPost->getMpgResponse();

        return dd($mpgResponse);


        print("\nCardType = " . $mpgResponse->getCardType());
        print("\nTransAmount = " . $mpgResponse->getTransAmount());
        print("\nTxnNumber = " . $mpgResponse->getTxnNumber());
        print("\nReceiptId = " . $mpgResponse->getReceiptId());
        print("\nTransType = " . $mpgResponse->getTransType());
        print("\nReferenceNum = " . $mpgResponse->getReferenceNum());
        print("\nResponseCode = " . $mpgResponse->getResponseCode());
        print("\nISO = " . $mpgResponse->getISO());
        print("\nMessage = " . $mpgResponse->getMessage());
        print("\nIsVisaDebit = " . $mpgResponse->getIsVisaDebit());
        print("\nAuthCode = " . $mpgResponse->getAuthCode());
        print("\nComplete = " . $mpgResponse->getComplete());
        print("\nTransDate = " . $mpgResponse->getTransDate());
        print("\nTransTime = " . $mpgResponse->getTransTime());
        print("\nTicket = " . $mpgResponse->getTicket());
        print("\nTimedOut = " . $mpgResponse->getTimedOut());
        print("\nStatusCode = " . $mpgResponse->getStatusCode());
        print("\nStatusMessage = " . $mpgResponse->getStatusMessage());
        print("\nMCPAmount = " . $mpgResponse->getMCPAmount());
        print("\nMCPCurrenyCode = " . $mpgResponse->getMCPCurrencyCode());


    }

}
