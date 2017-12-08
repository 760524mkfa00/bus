<?php

namespace busRegistration\Http\Controllers\Admin;

use busRegistration\Child;
use busRegistration\Http\Requests\UpdateStudentRequest;
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

    public function update(User $user, Child $child, UpdateStudentRequest $updateStudentRequest)
    {

        $this->saveStudent($user, $child, $updateStudentRequest->all());

        $student = Child::find($updateStudentRequest->get('child_id'));

        return \Redirect::route('edit_student', [$user, $student]);
    }


    public function saveStudent(User $parent, Child $child,$data)
    {

        $child->update([
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
            "int_start_date" => $data['int_start_date'] ?? NULL,
            "int_end_date" => $data['int_end_date'] ?? NULL,
            "medical_information" => $data['medical_information'],
            "student_note" => $data['student_note']
        ]);

    }

}
