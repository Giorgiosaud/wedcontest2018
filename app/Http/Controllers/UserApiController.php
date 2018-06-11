<?php

namespace App\Http\Controllers;

use App\User;

class UserApiController extends Controller
{
    /**
     * [index description].
     *
     * @return [type] [description]
     */
    public function index()
    {
        return User::with('contestants', 'roles')->get();
    }
}
