<?php

namespace App\Http\Controllers;

use App\Contest;

class GalleryController extends Controller
{
    public function index()
    {
       $contestToShow=Contest::with('categories.artworks')->whereActive(true)->get()->last();
       return view('gallery.show', ['contest'=>$contestToShow]);    
   }

   public function show(Contest $contest)
   {
        // $contestToShow=Contest::with('categories.artworks')->whereActive(true)->get();
        // ,compact('contestToShow')
    return view('gallery.show', compact('contest'));
}

    //
}
