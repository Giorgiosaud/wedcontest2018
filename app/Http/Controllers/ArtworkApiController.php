<?php

namespace App\Http\Controllers;

use App\Category;
use App\Contest;
use Illuminate\Http\Request;

class ArtworkApiController extends Controller
{
	public function index(){
		$contest=Contest::with('categories.artworks')->whereActive(true)->get();
		return $contest;
	}
	public function show(Contest $contest){
		$contest->load('categories.artworks')->get();
		return $contest;
	}
}
