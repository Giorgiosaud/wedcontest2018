<?php

namespace App\Http\Controllers\Auth;

//c19204190f3333eca314a425b
use App\Contest;
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
        if ($user->isJudge()) {
            $contest = Contest::whereActive(true)->first();

            return redirect(route('evaluation.show', $contest));
        }

        return redirect(route('the_contest'))
            ->with('flash', 'Your account is now confirmed! Now you can register the participants.');
    }
}
