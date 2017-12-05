<?php

namespace busRegistration\Http\Controllers;

use busRegistration\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $schools = School::all();

        return view('schools.index')
            ->withBuildings($schools);
    }

    public function create()
    {
        return view('schools.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'school' => 'required|unique:schools|max:255'
        ]);

        School::create([
            'school' => $request->input('school')
        ]);

        return \Redirect::route('list_school')->with('flash_message', 'School has been created.');

    }

    public function destroy(School $school)
    {
        
        try {
            $school->delete();
        }
        catch(\Exception $e)
        {
            return \Redirect::back()->withErrors('You cannot delete this item, it may has information attached to it. Please remove that information first');
        }

        return \Redirect::route('list_school')->with('flash_message', 'School has been removed.');
    }

}
