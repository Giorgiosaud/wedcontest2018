<?php

namespace App\Http\Controllers;

use App\Category;
use App\Contest;
use Illuminate\Http\Request;

class AdminEvaluationController extends Controller
{
	public function index(Contest $selectedContest){
		return view('admin.evaluations.show', compact('selectedContest'));;
	}
	public function show(Contest $contest, Category $category)
	{	
		$artworks=$category->artworks->load('answers');
		if($category->name==='Seeds'||$category->name==='Sprouts')
		return view('admin.evaluations.simple', compact('category', 'contest','artworks'));
		return view('admin.evaluations.complex', compact('category', 'contest'));

	}
}
