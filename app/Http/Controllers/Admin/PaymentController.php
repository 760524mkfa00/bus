<?php

namespace busRegistration\Http\Controllers\Admin;


use busRegistration\Http\PaymentGateway\moneris\mpgAvsInfo;
use busRegistration\Http\PaymentGateway\moneris\mpgCvdInfo;
use busRegistration\Http\PaymentGateway\moneris\mpgHttpsPost;
use busRegistration\Http\PaymentGateway\moneris\mpgRecur;
use busRegistration\Http\PaymentGateway\moneris\mpgRequest;
use busRegistration\Http\PaymentGateway\moneris\mpgTransaction;
use busRegistration\Http\PaymentGateway\moneris\paymentActions;
use busRegistration\User;
use busRegistration\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use busRegistration\Http\Controllers\Controller;

class PaymentController extends Controller
{
//
//    protected $store_id;
//
//    protected $api_token;

    protected $paymentGateway;


    public function __construct(PaymentActions $paymentActions)
    {

        $this->middleware('auth');

        $this->paymentGateway = $paymentActions;

//        $this->store_id = env('MONERIS_ID');
//
//        $this->api_token = env('MONERIS_KEY');
    }

    public function index(Order $order)
    {

        if ($order->parent_id != Auth()->id()) {
            return back()->withErrors('You do not have access to this page');
        }

        if ($order->netAmount() < 1) {
            return back()->withErrors('You do not have a payment to make at this time.');
        }



        $parent = User::where('id', $order->parent_id)->first();
        $ordering = $order->where('id', $order->id)->with('children')->first();

        $end = Carbon::parse('2018-06-01');
        $now = Carbon::now();
        $length = $end->diffInMonths($now);


        $paymentOptions['full'] = $ordering->netAmount();
        $paymentOptions['split'] = $paymentOptions['full'] / 2;
        $paymentOptions['multiple'] = $paymentOptions['full'] / $length;
        $paymentOptions['now'] = $now->format('M/D/YY');
        $paymentOptions['plusMonth'] = $now->addDays(30)->format('M d, Y');
        $paymentOptions['multipleMonths'] = $length;


        return view('payments.details')
            ->withParent($parent)
            ->withOrder($ordering)
            ->withOptions($paymentOptions);
    }



    public function submitPayment(Request $request, Order $order)
    {

        if ($order->parent_id != Auth()->id()) {
            return back()->withErrors('You do not have access to this page');
        }

        $details = $request->all();
        $details['expdate'] = $details['expiry_year'] . $details['expiry_month'];
        $details['custNumber'] = $order->parent_id;
        $details['orderNumber'] = $order->order_number;
        $details['amount'] = '10.30';

        $this->paymentGateway->pay($details, $order);

    }


    /*
     * Recurring payments
     *
     *
     */

    public function recurringPayment()
    {
//        /********************************* Recur Variables ****************************/
//        $recurUnit = 'eom';
//        $startDate = '2018/11/30';
//        $numRecurs = '4';
//        $recurInterval = '10';
//        $recurAmount = '31.00';
//        $startNow = 'true';
//
//        /************************* Transactional Variables ****************************/
//
//        $orderId = 'ord-' . date("dmy-G:i:s");
//        $custId = 'student_number';
//        $creditCard = '5454545454545454';
//        $nowAmount = '10.00';
//        $expiryDate = '0912';
//        $cryptType = '7';
//
//        /*********************** Recur Associative Array **********************/
//
//        $recurArray = array('recur_unit' => $recurUnit, // (day | week | month)
//            'start_date' => $startDate, //yyyy/mm/dd
//            'num_recurs' => $numRecurs,
//            'start_now' => $startNow,
//            'period' => $recurInterval,
//            'recur_amount' => $recurAmount
//        );
//
//        $mpgRecur = new mpgRecur();
//        $mpgRecur->mpgRecur($recurArray);
//
//        /*********************** Transactional Associative Array **********************/
//
//        $txnArray = array('type' => 'purchase',
//            'order_id' => $orderId,
//            'cust_id' => $custId,
//            'amount' => $nowAmount,
//            'pan' => $creditCard,
//            'expdate' => $expiryDate,
//            'crypt_type' => $cryptType
//        );
//
//        /**************************** Transaction Object *****************************/
//
//        $mpgTxn = new mpgTransaction();
//        $mpgTxn->mpgTransaction($txnArray);
//
//        /****************************** Recur Object *********************************/
//
//        $mpgTxn->setRecur($mpgRecur);
//
//        /****************************** Request Object *******************************/
//
//        $mpgRequest = new mpgRequest();
//        $mpgRequest->mpgRequest($mpgTxn);
//        $mpgRequest->setProcCountryCode("CA"); //"US" for sending transaction to US environment
//        $mpgRequest->setTestMode(true); //false or comment out this line for production transactions
//
//        /***************************** HTTPS Post Object *****************************/
//
//        $mpgHttpPost = new mpgHttpsPost();
//        $mpgHttpPost->mpgHttpsPost('store5', 'yesguy', $mpgRequest);
//
//        /******************************* Response ************************************/
//
//        $mpgResponse = $mpgHttpPost->getMpgResponse();
//
//        print ("\nCardType = " . $mpgResponse->getCardType());
//        print("\nTransAmount = " . $mpgResponse->getTransAmount());
//        print("\nTxnNumber = " . $mpgResponse->getTxnNumber());
//        print("\nReceiptId = " . $mpgResponse->getReceiptId());
//        print("\nTransType = " . $mpgResponse->getTransType());
//        print("\nReferenceNum = " . $mpgResponse->getReferenceNum());
//        print("\nResponseCode = " . $mpgResponse->getResponseCode());
//        print("\nISO = " . $mpgResponse->getISO());
//        print("\nMessage = " . $mpgResponse->getMessage());
//        print("\nIsVisaDebit = " . $mpgResponse->getIsVisaDebit());
//        print("\nAuthCode = " . $mpgResponse->getAuthCode());
//        print("\nComplete = " . $mpgResponse->getComplete());
//        print("\nTransDate = " . $mpgResponse->getTransDate());
//        print("\nTransTime = " . $mpgResponse->getTransTime());
//        print("\nTicket = " . $mpgResponse->getTicket());
//        print("\nTimedOut = " . $mpgResponse->getTimedOut());
//        print("\nRecurSuccess = " . $mpgResponse->getRecurSuccess());
    }

}
