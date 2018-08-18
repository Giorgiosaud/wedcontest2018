<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class QuestionsApiController extends Controller
{
	public function get(Category $category){
		return $category->questions;
	}
	public function post(){
		$user=auth()->user();
		dd($user);
	}

        //
}
