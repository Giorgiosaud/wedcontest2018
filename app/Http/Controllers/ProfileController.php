<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
	function __construct( ){
		$this->middleware('auth');
	}
    //
    public function edit()
    {
        return view('profile.edit');
    }
}
