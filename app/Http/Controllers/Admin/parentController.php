<?php

namespace busRegistration\Http\Controllers\Admin;

use busRegistration\User;
use Illuminate\Http\Request;
use busRegistration\Http\Controllers\Controller;

class parentController extends Controller
{
    //

    public function __construct()
    {

        $this->middleware('auth');

    }

    public function update(User $user)
    {
        //
    }
}
