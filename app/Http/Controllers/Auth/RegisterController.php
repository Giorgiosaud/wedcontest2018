<?php

namespace App\Http\Controllers\Auth;

use App\Country;
use App\Events\RegisterRepresentant;
use App\Mail\PleaseConfirmYourEmail;
use App\Mail\PorFavorConfirmeSuCorreo;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Webpatser\Countries\Countries;

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

    public function showRegistrationForm()
    {
        $countries=Country::all();
        return view('auth.register',compact('countries'));
    }


    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/the_contest';

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
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
//        dd('he');
        return Validator::make($data, [
            'subscribed' => 'boolean',
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'country' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'referred' => 'required',
            'language' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'country' => $data['country'],
            'phone' => $data['phone'],
            'referred' => $data['referred'],
            'language' => $data['language'],
            'subscribed' => $data['subscribed'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'confirmation_token' => str_limit(md5($data['email'] . str_random()), 25, '')
        ]);
    }

    protected function registered(Request $request, $user)
    {
        event(new RegisterRepresentant($user));
//
    }
}
