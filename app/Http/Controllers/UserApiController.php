<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserApiController extends Controller
{
	/**
	 * [index description]
 	* @return [type] [description]
 	*/
 	public function index(){
 		return User::all();;
 	}
 }
