<?php

namespace busRegistration\Http\Controllers\Application;

use busRegistration\Child;
use busRegistration\User;
use Illuminate\Http\Request;
use busRegistration\Http\Requests\storeParent;
use busRegistration\Http\Controllers\Controller;

class ApplicationController extends Controller
{

    public function registerStudent()
    {
        return view('student.create');
    }

    public function storeStudent(Request $request)
    {

        $parent = User::find(Auth()->id());

        $data = $request->all();

        Child::create([
            "parent_id" => $parent->id,
            "first_name" => $data['first_name'],
            "last_name" => $data['last_name'],
            "grade_id" => $data['grade_id'],
            "current_school_id" => $data['current_school_id'],
            "next_school_id" => $data['next_school_id'],
            "address" => $data['address'] ?? $parent->address,
            "city" => $data['city'] ?? $parent->city,
            "province" => $data['province'] ?? $parent->province,
            "postal_code" => $data['postal_code'] ?? $parent->postal_code,
            "international" => $data['international'],
            "int_start_date" => $data['int_start_date'],
            "int_end_date" => $data['int_end_date'],
            "year" => 2017,
        ]);

        return redirect()->route('home');
    }
}
