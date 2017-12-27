<?php

namespace busRegistration\Http\Controllers;

use busRegistration\Edulog;
use Illuminate\Http\Request;

class EdulogConnection extends Controller
{

    protected $edulog;

    public function __construct(Edulog $edulog)
    {
        $this->middleware('auth');

        $this->edulog = $edulog;
    }

    public function index()
    {



    }
}
