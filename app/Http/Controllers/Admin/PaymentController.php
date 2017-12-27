<?php

namespace busRegistration\Http\Controllers\Admin;

use busRegistration\Http\PaymentGateway\mpgHttpsPost;
use busRegistration\Http\PaymentGateway\mpgRequest;
use busRegistration\Http\PaymentGateway\mpgResponse;
use busRegistration\Http\PaymentGateway\mpgTransaction;

use busRegistration\User;
use busRegistration\Order;
use Illuminate\Http\Request;
use busRegistration\Http\Controllers\Controller;

class PaymentController extends Controller
{

    protected $store_id;

    protected $api_token;

    protected $mpgResponse;

    public function __construct(mpgResponse $mpgResponse)
    {

        $this->middleware('auth');

        $this->store_id = env('MONERIS_ID');

        $this->api_token = env('MONERIS_KEY');

        $this->mpgResponse = $mpgResponse;



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

        $details = $request->all();

        $details['expdate'] = preg_replace('/[^0-9]/', '', $details['expdate']);
//        dd($details);

        $txnArray = [
            $type='preauth',
            $order_id= $order->id,
            $cust_id= $order->parent_id,
            $amount='10.31',
            $pan= $details['pan'],
            $expiry_date='1206',
            $crypt='7',
        ];

        $mpgTxn = new mpgTransaction($txnArray);

        $mpgRequest = new mpgRequest($mpgTxn);
        $mpgRequest->setProcCountryCode("CA"); //"CA" for sending transaction to Canadian environment
        $mpgRequest->setTestMode(true);

        $mpgHttpPost = new mpgHttpsPost($this->store_id, $this->api_token, $mpgRequest);


        $mpgResponse = $mpgHttpPost->getMpgResponse();

        dd($mpgHttpPost);

        print ("\nCardType = " . $mpgResponse->getCardType());
        print("\nTransAmount = " . $mpgResponse->getTransAmount());
        print("\nTxnNumber = " . $mpgResponse->getTxnNumber());
        print("\nReceiptId = " . $mpgResponse->getReceiptId());
        print("\nTransType = " . $mpgResponse->getTransType());
        print("\nReferenceNum = " . $mpgResponse->getReferenceNum());
        print("\nResponseCode = " . $mpgResponse->getResponseCode());
        print("\nMessage = " . $mpgResponse->getMessage());
        print("\nAuthCode = " . $mpgResponse->getAuthCode());
        print("\nComplete = " . $mpgResponse->getComplete());
        print("\nTransDate = " . $mpgResponse->getTransDate());
        print("\nTransTime = " . $mpgResponse->getTransTime());
        print("\nTicket = " . $mpgResponse->getTicket());
        print("\nTimedOut = " . $mpgResponse->getTimedOut());
        print("\nAVSResponse = " . $mpgResponse->getAvsResultCode());
        print("\nCVDResponse = " . $mpgResponse->getCvdResultCode());
        print("\nCardLevelResult = " . $mpgResponse->getCardLevelResult());


    }

}
