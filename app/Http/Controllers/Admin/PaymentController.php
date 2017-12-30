<?php

namespace busRegistration\Http\Controllers\Admin;


use busRegistration\Http\PaymentGateway\mpgAvsInfo;
use busRegistration\Http\PaymentGateway\mpgCvdInfo;
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
        // TODO: Make sure the parent owns this order when making payment

        $details = $request->all();

        $details['expdate'] = preg_replace('/[^0-9]/', '', $details['expdate']);


        /************************* Transactional Variables ****************************/

        $type='preauth';
        $cust_id= $order->parent_id;
        $order_id= 'SD23-' . $order->order_number;
        $amount='10.30';
        $pan=$details['pan'];
        $expiry_date=$details['expdate'];
        $crypt='7';
//        $dynamic_descriptor='123';
        $status_check = 'false';

        /******************* Customer Information Variables ********************/

        $first_name = $details['billing_first_name'];
        $last_name = $details['billing_last_name'];
        $number = $details['billing_address_number'];
        $street = $details['billing_address_street'];
        $postal_code = $details['billing_postal_code'];
        $email =$details['email'];
        /*********************** Transactional Associative Array **********************/

        $txnArray=array('type'=>$type,
            'order_id'=>$order_id,
            'cust_id'=>'kieran',
            'amount'=>$amount,
            'pan'=>$pan,
            'expdate'=>$expiry_date,
            'crypt_type'=>$crypt
        );

        /********************** AVS Associative Array *************************/

        $avsTemplate = array(

            'avs_street_number'=> $number,
            'avs_street_name' => $street,
            'avs_zipcode' => $postal_code
//            'avs_email' => $email,
        );

        /********************** CVD Associative Array *************************/

        $cvdTemplate = array(
            'cvd_indicator' => '1',
            'cvd_value' => $details['cvc']
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

        $mpgHttpPost  =new mpgHttpsPost();
        $mpgHttpPost->mpgHttpsPost('store5','yesguy',$mpgRequest);
//        $mpgHttpPost->mpgHttpsPost($this->store_id,$this->api_token,$mpgRequest);

        /******************************* Response ************************************/
        $mpgResponse=$mpgHttpPost->getMpgResponse();

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
