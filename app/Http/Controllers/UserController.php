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
	/**
     * [makeAdmin description]
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function toggleAdmin(User $user){

        if($user->roles->pluck('id')->contains('1')){
        	$user->roles()->detach('1');
        }
        else{
        	$user->roles()->attach('1');
        };
        return view('users.index');
    }
}
