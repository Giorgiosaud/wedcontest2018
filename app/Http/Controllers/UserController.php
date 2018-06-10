<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index(){
		return view('users.index');
	}
}
