<?php

namespace busRegistration\Http\Controllers\Admin;

use busRegistration\Child;
use busRegistration\User;
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

    public function edit(User $user, Child $child)
    {

        $user = $user->with('children', 'children.nextSchool', 'children.currentSchool', 'children.grade', 'children.tags', 'notifications')->find($user->id);

        return view('student.edit')
            ->withUser($user)
            ->withCurrentChild($child);
    }

}
