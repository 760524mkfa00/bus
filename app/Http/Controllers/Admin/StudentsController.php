<?php

namespace busRegistration\Http\Controllers\Admin;

use busRegistration\Edulog;
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

    protected $edulog;

    public function __construct(Edulog $edulog)
    {

        $this->middleware('auth');

        $this->edulog = $edulog;

    }


    public function index()
    {

        $this->setFilters();

        $filter = Session::get('searchValues');


        $child = Child::with('order', 'order.parent', 'order.parent.order', 'order.parent.order.children', 'nextSchool', 'grade')
            ->whereHas('order.parent', function ( $query ) use ($filter) {
                if($filter['phone']) $query->telePhone($filter['phone']);
            })
            ->WhereHas('order.parent', function ( $query ) use ($filter) {
                if($filter['parentName']) $query->searchParentName($filter['parentName']);
            })
            ->searchStudentName($filter['studentName'])
            ->searchSeat($filter['seat'])
            ->searchPaid($filter['paid'])
            ->searchSubsidy($filter['subsidy'])
            ->searchInternational($filter['international'])
            ->searchProcessed($filter['processed'])
            ->searchTag($filter['tag'])
            ->searchCreated($filter['created_at'])
            ->orderBy($filter['sortBy'], $filter['direction'])
            ->paginate(10);


        foreach($child as $student) {
            $student->order->parent->siblings = $student->order->parent->order->map( function($item, $key) {
                return $item->children->count();
            })->sum();
        }

        return view('student.index')
            ->withStudents($child);

    }


    public function setFilters()
    {

        if(!$filter = \Request::all())
        {
            if (Session::exists('searchValues')) {
                $searchValue = Session::get('searchValues');

                $filter['studentName'] = $searchValue['studentName'] ?? '';
                $filter['parentName'] = $searchValue['parentName'] ?? '';
                $filter['phone'] = $searchValue['phone'] ?? '';
                $filter['seat'] = $searchValue['seat'] ?? '';
                $filter['paid'] = $searchValue['paid'] ?? '';
                $filter['subsidy'] = $searchValue['subsidy'] ?? '';
                $filter['international'] = $searchValue['international'] ?? '';
                $filter['processed'] = $searchValue['processed'] ?? '';
                $filter['tag'] = $searchValue['tag'] ?? '';
                $filter['created_at'] = $searchValue['created_at'] ?? '';
                $filter['sortBy'] = $searchValue['sortBy'] ?? 'first_name';
                $filter['direction'] = $searchValue['direction'] ?? 'asc';
            } else {
                $filter['studentName'] = '';
                $filter['parentName'] = '';
                $filter['phone'] = '';
                $filter['seat'] = '';
                $filter['paid'] = '';
                $filter['subsidy'] = '';
                $filter['international'] = '';
                $filter['processed'] = '';
                $filter['tag'] = '';
                $filter['created_at'] = '';
                $filter['sortBy'] = 'first_name';
                $filter['direction'] = 'asc';
            }

        } else {
            $filter['studentName'] = $filter['studentName'] ?? '';
            $filter['parentName'] = $filter['parentName'] ?? '';
            $filter['phone'] = $filter['phone'] ?? '';
            $filter['seat'] = $filter['seat'] ?? '';
            $filter['paid'] = $filter['paid'] ?? '';
            $filter['subsidy'] = $filter['subsidy'] ?? '';
            $filter['international'] = $filter['international'] ?? '';
            $filter['processed'] = $filter['processed'] ?? '';
            $filter['tag'] = $filter['tag'] ?? '';
            $filter['created_at'] = $filter['created_at'] ?? '';
            $filter['sortBy'] = $filter['sortBy'] ?? 'first_name';
            $filter['direction'] = $filter['direction'] ?? 'asc';
        }

        Session::put('searchValues', $filter);

        return $filter;
    }



    public function edit(User $user, Child $child)
    {

        $user = $user->with('order', 'order.children', 'order.children.nextSchool', 'order.children.currentSchool', 'order.children.grade', 'order.children.tags', 'notifications', 'order.children.discount')->find($user->id);



        $selected = $child->tags->pluck('id')->toArray();

        foreach ($user->order as $order) {
            $order->amount = $order->children->map( function($item, $key) {
                return $item->amount;
            })->sum();
            $order->netAmount = $order->children->map( function($item, $key) {
                return $item->netAmount();
            })->sum();

        }

        $edulogUser = ($child->map_system_id) ? $this->edulog->EdulogUser((int) $child->map_system_id) : new Edulog();

        return view('student.edit')
            ->withUser($user)
            ->withCurrentChild($child)
            ->withSelectedTags($selected)
            ->withEdulog($edulogUser);
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
            "amount" => $data['amount'] ?? 0.00,
            "discount_amount" => $data['discount_amount'],
            "discount_id" => $data['discount_id'],
            "map_system_id" => $data['map_system_id']
        ]);

        if (isset($data['tag'])) {
            $child->tags()->sync($data['tag']);
        } else {
            $child->tags()->detach();
        }

        Return $child;

    }

}
