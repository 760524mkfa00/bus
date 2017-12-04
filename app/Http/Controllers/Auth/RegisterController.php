<?php

namespace busRegistration\Http\Controllers\Auth;

use busRegistration\Role;
use busRegistration\User;
use busRegistration\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users|confirmed',
            'password' => 'required|min:6|confirmed',
            'primary_phone' => 'required|max:20',
            'secondary_phone' => 'required|max:20',
            'address' => 'required|max:50',
            'city' => 'required|max:20',
            'province' => 'required|max:20',
            'postal_code' => 'required|max:20',
            'accept_rules' => 'required|accepted',
            'accept_video' => 'required|accepted',
            'accept_email' => 'required|accepted',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \busRegistration\User
     */
    protected function create(array $data)
    {

//        dd($data);
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'primary_phone' => $data['primary_phone'],
            'secondary_phone' => $data['secondary_phone'],
            'address' => $data['address'],
            'city' => $data['city'],
            'province' => $data['province'],
            'postal_code' => $data['postal_code'],
            'accept_rules' => $data['accept_rules'],
            'accept_video' => $data['accept_video'],
            'accept_email' => $data['accept_email'],
        ]);

//        Role::where('name', '=', 'parent');
        $user->roles()->attach(Role::where('slug', '=', 'parent')->pluck('id'));
        return $user;
    }
}
