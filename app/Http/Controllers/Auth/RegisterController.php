<?php

namespace App\Http\Controllers\Auth;

use App\Contest;
use App\Country;
use App\Events\RegisterRepresentant;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
        $countries = Country::all();
        $contest = Contest::whereActive(true)->first();

        return view('auth.register', compact('countries', 'contest'));
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
     * @param array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
//        dd('he');
        return Validator::make($data, [
            'name'       => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users',
            'country'    => 'required|string|max:255',
            'phone'      => 'required|string|max:255',
            'referred'   => 'required',
            // 'referred_specify'   => 'string',
            'language'   => 'required|string|max:255',
            'password'   => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     *
     * @return \App\User
     */
    protected function create(array $data)
    {
        // dd($data);
        return User::create([
            'name'                => $data['name'],
            'last_name'           => $data['last_name'],
            'country'             => $data['country'],
            'phone'               => $data['phone'],
            'referred'            => $data['referred'],
            'referred_specify'    => $data['referred_specify'],
            'language'            => $data['language'],
            'subscribed'          => $data['subscribed'],
            'confirmed'           => false,
            'email'               => $data['email'],
            'password'            => Hash::make($data['password']),
            'confirmation_token'  => str_limit(md5($data['email'].str_random()), 25, ''),
        ]);
    }

    protected function registered(Request $request, $user)
    {
        event(new RegisterRepresentant($user));
    }
}
