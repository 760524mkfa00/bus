<?php

namespace busRegistration\Http\Controllers\Admin;

use busRegistration\Child;
use Illuminate\Http\Request;
use busRegistration\Http\Controllers\Controller;

class StudentsController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');

    }


    public function index()
    {

        $child = Child::with('parent', 'parent.children', 'nextSchool', 'grade')->get();

//        dd($child);
        return view('student.index')
            ->withStudents($child);



    }

}
