<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
	public function translateActive(){
		return view('translate.index');
	}
    //
}
