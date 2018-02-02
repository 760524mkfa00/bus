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

    protected $errors = [];


    public function __construct()
    {

        $this->middleware('auth');

    }
//                'api_key' => env('MONERIS_KEY'),
//                'store_id' => env('MONERIS_ID'),
    public function config()
    {
        $this->moneris = Moneris::create(
            array(
                'api_key' => 'yesguy',
                'store_id' => 'store5',
                'environment' => Moneris::ENV_TESTING,
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
        $orders = $order->where('id', $order->id)->with('children')->first();

        $paymentOptions = $this->paymentOptions($orders);


        return view('payments.details')
            ->withParent($parent)
            ->withOrder($orders)
            ->withOptions($paymentOptions);
    }


    private function paymentOptions(Order $order)
    {

//        TODO: set the year to use the config year +1 as this is the end date payments can go to.
        $end = Carbon::parse('2018-06-01');
        $now = Carbon::now();
        $length = $end->diffInMonths($now);


        $paymentOptions['full'] = $order->netAmount();
        $paymentOptions['split'] = $paymentOptions['full'] / 2;
        $paymentOptions['multiple'] = $paymentOptions['full'] / $length;
        $paymentOptions['now'] = $now->format('M/D/YY');
        $paymentOptions['plusMonth'] = $now->addDays(30)->format('M d, Y');
        $paymentOptions['multipleMonths'] = $length;

        return $paymentOptions;

    }



    public function submitPayment(Request $request, Order $order)
    {

        if ($order->parent_id != Auth()->id()) {
            return back()->withErrors('You do not have access to this page');
        }

        $details = $request->all();

        $recurUnit = 'eom';
        $startDate = '2018/02/02';
        $numRecurs = '4';
        $recurInterval = '10';
        $recurAmount = '31.00';
        $startNow = 'true';

//        $recurArray = array(
//            'recur_unit'=>$recurUnit, // (day | week | month)
//            'start_date'=>$startDate, //yyyy/mm/dd
//            'num_recurs'=>$numRecurs,
//            'start_now'=>$startNow,
//            'period' => $recurInterval,
//            'recur_amount'=> $recurAmount
//        );
//
//        $mpgRecur = new mpgRecur($recurArray);


        $params = [
            'order_id' => $order->order_number,
            'cc_number' => $details['pan'],
//            'amount' => $order->netAmount(),
            'amount' => $recurAmount,
            'expiry_month' => $details['expiry_month'],
            'expiry_year' => $details['expiry_year'],
            'avs_street_number' => $details['billing_address_number'],
            'avs_street_name' => $details['billing_address_street'],
            'avs_zipcode' => $details['billing_postal_code'],
            'cvd' => $details['cvc'],

            'recur_unit'=>$recurUnit, // (day | week | month)
            'start_date'=>$startDate, //yyyy/mm/dd
            'num_recurs'=>$numRecurs,
            'start_now'=>$startNow,
            'period' => $recurInterval,
            'recur_amount'=> $recurAmount

        ];


        $transaction = $this->purchase($params);

        dd($transaction);

        if ((string)$transaction->receipt->Complete === 'false') {
            return back()->withErrors('There was a problem with the transaction: ' . (string)$transaction->receipt->Message . '. The amount taken from your card was ' . (string)$transaction->receipt->TransAmount);
        }

        if($this->errors) {
            return back()->withErrors($this->errors);
        }

        $order = $this->updateOrder($transaction, $order->id);

        // TODO: send out route info with pass information or display an option to download passes on home screen.

        return \Redirect::route('home')->with('flash_message', 'Thank you for your payment, you will now be able to download bus passes for paid students.');

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
        $this->config();

        $purchase_result = $this->moneris->purchase($params);

        if ($purchase_result->was_successful() && ($purchase_result->failed_avs() || $purchase_result->failed_cvd())) {
            $this->errors = $purchase_result->error_message();
            $void = $this->moneris->void($purchase_result->transaction());
        } else if (!$purchase_result->was_successful()) {
            $this->errors = $purchase_result->error_message();
        }

        return $purchase_result->transaction()->response();
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
