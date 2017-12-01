<?php

namespace busRegistration\Http\Controllers\Application;

use Illuminate\Http\Request;
use busRegistration\Http\Requests\storeParent;
use busRegistration\Http\Controllers\Controller;

class ApplicationController extends Controller
{

    public function parentApplication()
    {
        return view('application.parent');
    }

    public function storeParent(storeParent $storeParent)
    {

        // TODO: Set year here from config and not in form as someone could change it.

        $parent = $storeParent->persist();

        return view('application.children')
            ->withParent($parent);

    }
}
