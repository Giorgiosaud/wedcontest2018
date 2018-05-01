<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class RegisterConfirmationController extends Controller
{
    protected $redirectTo = '/the_contest';

    public function index()
    {
        $user = User::where('confirmation_token', request('token'))->first();
        if (!$user) {
            return redirect(route('the_contest'))->with('flash', 'Unknown token.');
        }
        $user->confirm();

        return redirect(route('the_contest'))
            ->with('flash', 'Your account is now confirmed! Now you can register the participants.');
    }
}
