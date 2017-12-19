<?php

namespace busRegistration\Http\Controllers;

use busRegistration\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{


    public function __construct()
    {

        $this->middleware('auth');


    }

    public function index()
    {

        $tags = Tag::orderBy('tag')->get();

        return view('tags.index')
            ->withTags($tags);
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'tag' => 'required|unique:tags|max:50'
        ]);

        Tag::create([
            'tag' => $request->input('tag')
        ]);

        return \Redirect::route('list_tag')->with('flash_message', 'Tag has been created.');

    }

    public function destroy(Tag $tag)
    {

        try {
            $tag->delete();
        }
        catch(\Exception $e)
        {
            return \Redirect::back()->withErrors('You cannot delete this item, it may has information attached to it. Please remove that information first');
        }

        return \Redirect::route('list_tag')->with('flash_message', 'Tag has been removed.');
    }

}
