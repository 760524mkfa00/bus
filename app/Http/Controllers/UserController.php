<?php

namespace busRegistration\Http\Controllers;

use busRegistration\Http\Requests\UpdateUserRequest;
use busRegistration\Role;
use busRegistration\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(['roles'])->get();
        return view('users.index')
            ->withUsers($users);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.register');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $current = $user->roles()->first() ?? new Role();
        return view('users.edit')
            ->withUser($user)
            ->withCurrent($current);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, user $user)
    {
        $data = $request->only('first_name', 'last_name', 'email', 'active','primary_phone',
        'secondary_phone', 'address', 'city', 'province', 'postal_code',
        'comments', 'accept_rules', 'accept_video', 'accept_email');
        $user->fill($data)->save();
        $user->roles()->sync($request->get('role'));
        return redirect()->route('list_users');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if(User::count() < 2) return \Redirect::back()->withErrors('School Bus Registration needs at least 1 user.');
        try {
            $user->delete();
        }
        catch(\Exception $e)
        {
            return \Redirect::back()->withErrors('That\'s is not going to happen anytime soon, it would seem this user is being used with other data.');
        }
        return \Redirect::route('list_users')->with('flash_message', 'User has been removed.');
    }
}
