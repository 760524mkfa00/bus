<?php

namespace busRegistration\Http\Controllers;

use Illuminate\Http\Request;

class GradeController extends Controller
{
    //

    public function __construct()
    {

        $this->middleware('auth');

    }
}
