<?php

namespace busRegistration\Http\Controllers;

use busRegistration\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    //

    public function __construct()
    {

        $this->middleware('auth');

    }

    public function index()
    {

        $grades = Grade::all();

        return view('grades.index')
            ->withGrading($grades);
    }

    public function create()
    {
        return view('grades.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'grade' => 'required|unique:grades|max:255'
        ]);

        Grade::create([
            'grade' => $request->input('grade')
        ]);

        return \Redirect::route('list_grade')->with('flash_message', 'Grade has been created.');

    }

    public function destroy(Grade $grade)
    {

        try {
            $grade->delete();
        }
        catch(\Exception $e)
        {
            return \Redirect::back()->withErrors('You cannot delete this item, it may has information attached to it. Please remove that information first');
        }

        return \Redirect::route('list_grade')->with('flash_message', 'Grade has been removed.');
    }
}
