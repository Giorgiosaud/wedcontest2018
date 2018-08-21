<?php

namespace App\Http\Controllers\Auth;

use App\Contest;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/mycontestants';
    /**
     * [authenticated description]
     *
     * @return [type] [description]
     */
    public function authenticated($request , $user){
        if ($user->isJudge()) {
            $contest=Contest::whereActive(true)->first();
            return redirect(route('evaluation.show',$contest));
        }
    }
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        $contest = Contest::whereActive(true)->first();

        return view('auth.login', compact('contest'));
    }
}
