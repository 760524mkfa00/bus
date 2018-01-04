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


        $params = [
            'order_id' => $order->order_number,
            'cc_number' => $details['pan'],
            'amount' => $order->netAmount(),
            'expiry_month' => $details['expiry_month'],
            'expiry_year' => $details['expiry_year'],
            'avs_street_number' => $details['billing_address_number'],
            'avs_street_name' => $details['billing_address_street'],
            'avs_zipcode' => $details['billing_postal_code'],
            'cvd' => $details['cvc']
        ];


        $transaction = $this->purchase($params);

        if ((string)$transaction->receipt->Complete === 'false') {
            return back()->withErrors('There was a problem with the transaction: ' . (string)$transaction->receipt->Message . '. The amount taken from your card was ' . (string)$transaction->receipt->TransAmount);
        }

        if($this->errors) {
            return back()->withErrors($this->errors);
        }

        $order = $this->updateOrder($transaction);

        // TODO: Mark the students within this order as paid

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

    private function updateOrder($transaction)
    {

        $responseData = [
            'TransID' => (string)$transaction->receipt->TransID,
            'ReferenceNum' => (string)$transaction->receipt->ReferenceNum,
            'AuthCode' => (string)$transaction->receipt->AuthCode,
            'TransDate' => (string)$transaction->receipt->TransDate,
            'TransAmount' => (string)$transaction->receipt->TransAmount,
            'CardType' => (string)$transaction->receipt->CardType,
            'ReceiptId' => (string)$transaction->receipt->ReceiptId,
            'TransTime' => (string)$transaction->receipt->TransTime,
            'Complete' => (string)$transaction->receipt->Complete,
            'Message' => (string)$transaction->receipt->Message
        ];

        return $responseData;
    }

}
