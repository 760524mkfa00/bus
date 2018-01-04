<?php

namespace busRegistration\Http\Controllers\Admin;

use busRegistration\Http\PaymentGateway\Moneris\lib\Moneris;
use busRegistration\User;
use busRegistration\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use busRegistration\Http\Controllers\Controller;

class PaymentController extends Controller
{


    protected $paymentGateway;

    protected $moneris;


    public function __construct()
    {

        $this->middleware('auth');

    }



    public function config()
    {
        $this->moneris = Moneris::create(
            array(
                'api_key' => 'yesguy',
                'store_id' => 'store5',
                'environment' => Moneris::ENV_TESTING_CA,
                'require_avs' => true,
                'require_cvd' => true
            ));
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

        /**
         * Make a purchase.
         *
         * @param array $params An associative array.
         * 		Required:
         *			- order_id string A unique transaction ID, up to 50 chars
         * 			- cc_number int Any non-numeric characters will be stripped
         *			- amount float
         *			- expiry_month int 2 digit representation of the expiry month (01-12)
         * 			- expiry_year int last two digits of the expiry year
         * 			- avs_street_number string Up to 19 chars combined with street name
         *			- avs_street_name string
         * 			- avs_zipcode string Up to 10 chars
         *			- cvd

         */

        $details = $request->all();


        $params = [
            'order_id' => $order->order_number,
            'cc_number' => $details['pan'],
            'amount' => '10.30',
            'expiry_month' => $details['expiry_month'],
            'expiry_year' => $details['expiry_year'],
            'avs_street_number' => $details['billing_address_number'],
            'avs_street_name' => $details['billing_address_street'],
            'avs_zipcode' => $details['billing_postal_code'],
            'cvd' => $details['cvc']
        ];


        $this->config();

        $errors = array();
        $verification_result = $this->moneris->verify($params);

        dd($verification_result);

        if ($verification_result->was_successful() && $verification_result->passed_avs() && $verification_result->passed_cvd()) {

            $purchase_result = $this->moneris->purchase($params);

            if ($purchase_result->was_successful()) {
                dd('you got a payment success');
                // HOORAY! Party like it's 1999.
            } else {
                $errors[] = $purchase_result->error_message();
                dd($errors);
            }

        }


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
