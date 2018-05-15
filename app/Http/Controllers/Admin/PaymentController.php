<?php

namespace busRegistration\Http\Controllers\Admin;

use busRegistration\Http\PaymentGateway\Moneris\mpgAvsInfo;
use busRegistration\Http\PaymentGateway\Moneris\mpgCvdInfo;
use busRegistration\Http\PaymentGateway\Moneris\mpgHttpsPost;
use busRegistration\Http\PaymentGateway\Moneris\mpgRecur;
use busRegistration\Http\PaymentGateway\Moneris\mpgRequest;
use busRegistration\Http\PaymentGateway\Moneris\mpgTransaction;

use busRegistration\User;
use busRegistration\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use busRegistration\Http\Controllers\Controller;

class PaymentController extends Controller
{


    protected $paymentGateway;

    protected $errors = [];

    protected $mpgResponse;


    public function __construct()
    {

        $this->middleware('auth');

    }
//                'api_key' => env('MONERIS_KEY'),
//                'store_id' => env('MONERIS_ID'),


    public function index(Order $order)
    {

        if ($order->parent_id != Auth()->id()) {
            return back()->withErrors('You do not have access to this page');
        }

        if ($order->netAmount() < 1) {
            return back()->withErrors('You do not have a payment to make at this time.');
        }



        $parent = User::where('id', $order->parent_id)->first();
        $orders = $order->where('id', $order->id)->with('children')->first();

        $paymentOptions = $this->paymentOptions($orders);


        return view('payments.details')
            ->withParent($parent)
            ->withOrder($orders)
            ->withOptions($paymentOptions);
    }


    private function paymentOptions(Order $order)
    {

        $now = Carbon::now();

        $paymentOptions = $this->paymentAmounts($order);

        $paymentOptions['now'] = $now->format('M/D/YY');
        $paymentOptions['plusMonth'] = $now->addDays(30)->format('M d, Y');
        $paymentOptions['multipleMonths'] = $this->paymentLength();

        return $paymentOptions;

    }

    protected function paymentLength() {

//        TODO: set the year to use the config year +1 as this is the end date payments can go to.
        $end = Carbon::parse('2018-10-01');
        $now = Carbon::now();

//        check the purchase has not passed the final purchase date.
        if($now > $end) {
            return Abort('402', 'Can not make payment to this account, the date has past');
        }

//        The difference between the final month a payment can be made and the current month. must be 1 or more
        ($end->diffInMonths($now) == 0) ? $length = 1 : $length = $end->diffInMonths($now);

        return $length;

    }

    protected function paymentAmounts(Order $order) {

        $paymentAmount['full'] = $order->netAmount();
        $paymentAmount['split'] = $paymentAmount['full'] / 2;
        $paymentAmount['multiple'] = $paymentAmount['full'] / $this->paymentLength();

        return $paymentAmount;

    }

    public function submitPayment(Request $request, Order $order)
    {

        if ($order->parent_id != Auth()->id()) {
            return back()->withErrors('You do not have access to this page');
        }

        $details = $request->all();

        $paymentAmounts = $this->paymentAmounts($order);

        $length = ($details['paymentOption'] == 'split') ? 2 : $this->paymentLength();

        //gather all the parameters for the payment gateway
        $params = [
            'paymentOption' => $details['paymentOption'],
            'cust_id' => $order->parent_id,
            'order_id' => 'ord-' . $order->order_number . date("dmy-G:i:s"),
            'amount' => $paymentAmounts[$details['paymentOption']],
            'numRecurs' => $length,
            'pan' => $details['pan'],
            'expiry_date' => $details['expiry_month'] . $details['expiry_year'],
            'cvd_value' => $details['cvc'],
            'avs_street_number' => $details['billing_address_number'],
            'avs_street_name' => $details['billing_address_street'],
            'avs_zipcode' => $details['billing_postal_code'],
            'avs_email' => $details['email']

        ];

        $mpgResponse = $this->purchase($params);


        print("\nCardType = " . $mpgResponse->getCardType()); echo '</br>';
        print("\nTransAmount = " . $mpgResponse->getTransAmount()); echo '</br>';
        print("\nTxnNumber = " . $mpgResponse->getTxnNumber()); echo '</br>';
        print("\nReceiptId = " . $mpgResponse->getReceiptId()); echo '</br>';
        print("\nTransType = " . $mpgResponse->getTransType()); echo '</br>';
        print("\nReferenceNum = " . $mpgResponse->getReferenceNum()); echo '</br>';
        print("\nResponseCode = " . $mpgResponse->getResponseCode()); echo '</br>';
        print("\nISO = " . $mpgResponse->getISO()); echo '</br>';
        print("\nMessage = " . $mpgResponse->getMessage()); echo '</br>';
        print("\nIsVisaDebit = " . $mpgResponse->getIsVisaDebit()); echo '</br>';
        print("\nAuthCode = " . $mpgResponse->getAuthCode()); echo '</br>';
        print("\nComplete = " . $mpgResponse->getComplete()); echo '</br>';
        print("\nTransDate = " . $mpgResponse->getTransDate()); echo '</br>';
        print("\nTransTime = " . $mpgResponse->getTransTime()); echo '</br>';
        print("\nTicket = " . $mpgResponse->getTicket()); echo '</br>';
        print("\nTimedOut = " . $mpgResponse->getTimedOut()); echo '</br>';
        print("\nStatusCode = " . $mpgResponse->getStatusCode()); echo '</br>';
        print("\nStatusMessage = " . $mpgResponse->getStatusMessage());
//        if ((string)$transaction->receipt->Complete === 'false') {
//            return back()->withErrors('There was a problem with the transaction: ' . (string)$transaction->receipt->Message . '. The amount taken from your card was ' . (string)$transaction->receipt->TransAmount);
//        }
//
//        if($this->errors) {
//            return back()->withErrors($this->errors);
//        }
//
//        $order = $this->updateOrder($transaction, $order->id);

        // TODO: send out route info with pass information or display an option to download passes on home screen.

//        return \Redirect::route('home')->with('flash_message', 'Thank you for your payment, you will now be able to download bus passes for paid students.');

    }


    /*
     * Recurring payments
     *
     *
     */

    public function recurringPayment()
    {

    }

    /**
     * @param $params
     * @return $this|array
     */
    private function purchase($params)
    {

        /************************* Transactional Variables ****************************/
        $type = 'purchase';
        $cust_id = $params['cust_id'];
        $order_id = $params['order_id'];
        $amount = number_format($params['amount'],2);
        $pan = $params['pan'];
        $expiry_date = $params['expiry_date'];
        $crypt = '7';

        /************************** CVD Variables *****************************/

        $cvd_indicator = '1';
        $cvd_value = $params['cvd_value'];

        /************************** AVS Variables *****************************/

        $avs_street_number = $params['avs_street_number'];
        $avs_street_name = $params['avs_street_name'];
        $avs_zipcode = $params['avs_zipcode'];
        $avs_email = $params['avs_email'];


        $avsTemplate = array(
            'avs_street_number'=> $avs_street_number,
            'avs_street_name' => $avs_street_name,
            'avs_zipcode' => $avs_zipcode,
            'avs_email' => $avs_email,
        );

        /********************** CVD Associative Array *************************/

        $cvdTemplate = array(
            'cvd_indicator' => $cvd_indicator,
            'cvd_value' => $cvd_value
        );

        /************************** AVS Object ********************************/

        $mpgAvsInfo = new mpgAvsInfo ($avsTemplate);

        /************************** CVD Object ********************************/

        $mpgCvdInfo = new mpgCvdInfo ($cvdTemplate);

        /***************** Transactional Associative Array ********************/

        $txnArray=array(
            'type'=>$type,
            'order_id'=>$order_id,
            'cust_id'=>$cust_id,
            'amount'=>$amount,
            'pan'=>$pan,
            'expdate'=>$expiry_date,
            'crypt_type'=>$crypt
        );

        /********************** Transaction Object ****************************/

        $mpgTxn = new mpgTransaction($txnArray);




        /******** Check if they want to setup a recurring payment *************/

        if($params['paymentOption'] != 'full') {

            $date = new Carbon('first day of next month');

            /********************************* Recur Variables ****************************/
            $recurUnit = 'month';
            $startDate = $date->addDays(14)->format('Y/m/d');
//            dd($startDate);
            $numRecurs = $params['numRecurs'];;
            $recurInterval = '10';
            $recurAmount = $params['amount'];
            $startNow = 'true';

            /*********************** Recur Associative Array **********************/

            $recurArray = array('recur_unit'=>$recurUnit, // (day | week | month)
                'start_date'=>$startDate, //yyyy/mm/dd
                'num_recurs'=>$numRecurs,
                'start_now'=>$startNow,
                'period' => $recurInterval,
                'recur_amount'=> $recurAmount
            );

            $mpgRecur = new mpgRecur($recurArray);

            /****************************** Recur Object *********************************/

            $mpgTxn->setRecur($mpgRecur);

        }

        /************************ Set AVS and CVD *****************************/

//        $mpgTxn->setAvsInfo($mpgAvsInfo);
//        $mpgTxn->setCvdInfo($mpgCvdInfo);

        /************************ Request Object ******************************/

        $mpgRequest = new mpgRequest($mpgTxn);
        $mpgRequest->setProcCountryCode("CA"); //"US" for sending transaction to US environment
        $mpgRequest->setTestMode(true); //false or comment out this line for production transactions

        /*********************** HTTPS Post Object ****************************/


        $mpgHttpPost = new mpgHttpsPost('monca02245','K3YMAVg8PG5MsqdLozBi',$mpgRequest);

        /*************************** Response *********************************/



        return $mpgHttpPost->getMpgResponse();
        $this->mpgResponse = $mpgHttpPost->getMpgResponse();

        return;



    }

    private function updateOrder($transaction, $orderID)
    {

        $responseData = [
            'transaction_number' => (string)$transaction->receipt->TransID,
            'reference_number' => (string)$transaction->receipt->ReferenceNum,
            'auth_code' => (string)$transaction->receipt->AuthCode,
            'transaction_date' => (string)$transaction->receipt->TransDate,
            'paid_amount' => (string)$transaction->receipt->TransAmount,
            'card_type' => (string)$transaction->receipt->CardType,
            'receipt_id' => (string)$transaction->receipt->ReceiptId,
            'transaction_time' => (string)$transaction->receipt->TransTime,
            'transaction_complete' => (string)$transaction->receipt->Complete,
            'message' => (string)$transaction->receipt->Message
        ];

        $order = Order::find($orderID);
        $order->update($responseData);

        $order->children()->update(['paid' => 'yes']);

        return $order;
    }




}

