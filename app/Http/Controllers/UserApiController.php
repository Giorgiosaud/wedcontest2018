<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserApiController extends Controller
{
	/**
	 * [index description]
 	* @return [type] [description]
 	*/
 	public function index(){
 		return User::with('contestants','roles')->get();
 	}
 }
