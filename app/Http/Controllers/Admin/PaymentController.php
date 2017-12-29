<?php

namespace busRegistration\Http\Controllers\Admin;


use busRegistration\User;
use busRegistration\Order;
use Empg\Client;
use Empg\Configuration;
use Empg\HttpsPost\MpgHttpsPost;
use Empg\HttpsPost\Request\MpgRequest;
use Empg\HttpsPost\Transaction\MpgTransaction;
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


        $details = $request->all();

        $details['expdate'] = preg_replace('/[^0-9]/', '', $details['expdate']);

        $transaction = new MpgTransaction([
            'type' => 'res_mpitxn',
            'expdate' => '1807',
            'data_key' => 'FAFGAFGHFAGHSFHGA',
            'xid' => '99999999991902175641',
            'MD' => '224530',
            'merchantUrl' => 'www.test.com',
            'accept' => true,
            'userAgent' => 'Mozilla',
        ]);
        $requesting = new MpgRequest($transaction);

        $requesting->setProcCountryCode('CA');
        $requesting->setTestMode(true);

//        $client = new Client($this->store_id, $this->api_token);
        $config = new Configuration('store1', 'yesguy', [
            'env' => Configuration::ENV_TEST, 'debug' => true
        ]);
        $httpPost = new MpgHttpsPost($config, $requesting);
        $httpPost->execute();
        return $httpPost->getMpgResponse();



    }

}
