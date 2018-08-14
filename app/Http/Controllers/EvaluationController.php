<?php

namespace App\Http\Controllers;

use App\Category;
use App\Contest;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
	public function show(Contest $selectedContest){
		return view('evaluations.show',compact('selectedContest'));
	}
	public function make(Contest $contest,Category $category){
		return view('evaluations.make',compact('category','contest'));

	}
	
	
    //
}
