<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{
	function __construct( ){
		$this->middleware('auth');
	}
    //
    public function index()
    {
        return view('profile.index');
    }
}
