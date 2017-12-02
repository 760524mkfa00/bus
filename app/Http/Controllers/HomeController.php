<?php

namespace busRegistration\Http\Controllers;

use busRegistration\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = User::with('children')->findOrFail(Auth()->id());
        return view('home')
            ->withUser($user);

    }
}
