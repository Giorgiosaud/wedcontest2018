<?php

namespace App\Http\Controllers;

use App\Contest;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
	public function index(){
		// $contestToShow=Contest::with('categories.artworks')->whereActive(true)->get();
		// ,compact('contestToShow')
		return view('gallery.index');
	}
    //
}
