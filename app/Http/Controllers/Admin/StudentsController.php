<?php

namespace busRegistration\Http\Controllers\Admin;

use Session;
use busRegistration\User;
use busRegistration\Child;
use Illuminate\Http\Request;
use busRegistration\Mail\noSeat;
use busRegistration\Notification;
use busRegistration\Http\Controllers\Controller;
use busRegistration\Http\Requests\UpdateStudentRequest;

class StudentsController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth');

    }


    public function index()
    {

        if(!$filter = \Request::all())
        {
            if (Session::exists('searchValues')) {
                $searchValue = Session::get('searchValues');

                $filter['phone'] = $searchValue['phone'] ?? '';
                $filter['seat'] = $searchValue['seat'] ?? '';
                $filter['paid'] = $searchValue['paid'] ?? '';
                $filter['subsidy'] = $searchValue['subsidy'] ?? '';
                $filter['international'] = $searchValue['international'] ?? '';
                $filter['processed'] = $searchValue['processed'] ?? '';
                $filter['tag'] = $searchValue['tag'] ?? '';
                $filter['created_at'] = $searchValue['created_at'] ?? '';
            } else {
                $filter['phone'] = '';
                $filter['seat'] = '';
                $filter['paid'] = '';
                $filter['subsidy'] = '';
                $filter['international'] = '';
                $filter['processed'] = '';
                $filter['tag'] = '';
                $filter['created_at'] = '';
            }

        }
        Session::put('searchValues', $filter);


        $child = Child::with('parent', 'parent.children', 'nextSchool', 'grade')
            ->whereHas('parent', function ( $query ) use ($filter) {
                if($filter['phone']) $query->telePhone($filter['phone']);
            })->searchSeat($filter['seat'])
            ->searchPaid($filter['paid'])
            ->searchSubsidy($filter['subsidy'])
            ->searchInternational($filter['international'])
            ->searchProcessed($filter['processed'])
            ->searchTag($filter['tag'])
            ->searchCreated($filter['created_at'])
            ->get();

//        dd($child);
        return view('student.index')
            ->withStudents($child);

    }

    public function edit(User $user, Child $child)
    {

        $user = $user->with('children', 'children.nextSchool', 'children.currentSchool', 'children.grade', 'children.tags', 'notifications')->find($user->id);

        $selected = $child->tags->pluck('id')->toArray();

        return view('student.edit')
            ->withUser($user)
            ->withCurrentChild($child)
            ->withSelectedTags($selected);
    }

    public function update(User $user, Child $child, UpdateStudentRequest $updateStudentRequest)
    {

        $this->saveStudent($user, $child, $updateStudentRequest->all());

        $student = Child::find($updateStudentRequest->get('child_id'));

        if($updateStudentRequest->get('no-bus')) {
            \Mail::to($user)->send(new noSeat($user, $student));

            // Add this to parent notification
            Notification::create([
                'parent_id' => $user->id,
                'notification' => 'No Seat Email Sent'
            ]);
        }

        if($updateStudentRequest->get('updateStudent')) {
            return \Redirect::route('list_student');
        }

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
            "seat_assigned" => $data['seat_assigned'],
            "processed" => $data['processed'],
            "international" => $data['international'],
            "int_start_date" => $data['int_start_date'] ?? NULL,
            "int_end_date" => $data['int_end_date'] ?? NULL,
            "medical_information" => $data['medical_information'],
            "student_note" => $data['student_note'],
            "amount" => $data['amount'] ?? 0.00
        ]);

        if (isset($data['tag'])) {
            $child->tags()->sync($data['tag']);
        } else {
            $child->tags()->detach();
        }

        Return $child;

    }

}
