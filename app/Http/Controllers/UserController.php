<?php

namespace App\Http\Controllers;

use App\Events\ResendConfirmationLink;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * [index description].
     *
     * @return [type] [description]
     */
    public function index()
    {
        return view('users.index');
    }

    public function aliasify(User $user)
    {
        Auth::loginUsingId($user->id, true);

        return redirect('/the_contest');
    }

    /**
     * [makeAdmin description].
     *
     * @param User $user [description]
     *
     * @return [type] [description]
     */
    public function toggleAdmin(User $user)
    {
        if (auth()->user()->id !== $user->id) {
            $user->roles()->toggle('1');
        }

        return view('users.index');
    }

    /**
     * Delete User.
     *
     * @param Reply $reply [description]
     *
     * @return [type] [description]
     */
    public function destroy(User $user)
    {
        if (auth()->user()->id !== $user->id) {
            $user->delete();
        }

        return view('users.index');
    }

    public function resendConfirmationLink(User $user)
    {
        event(new ResendConfirmationLink($user));
    }
}
