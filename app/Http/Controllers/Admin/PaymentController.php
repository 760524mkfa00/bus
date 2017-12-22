<?php

namespace busRegistration\Http\Controllers\Admin;

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

        $parent = User::where('id', $order->parent_id)->get();

        return view('payments.details')
            ->withParent($parent)
            ->withOrder($order->with('children'));
    }

}
