<?php

namespace App\Http\Controllers;

use App\Artwork;
use App\Contest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function translateActive()
    {
        return view('translate.index');
    }

    public function translate(Contest $contest)
    {
        $contest->load('categories.artworks')->get();
        $catsId = $contest->categories->pluck('id');
        $artworks = Artwork::whereIn('category_id', $catsId)->whereState('approved')->orWhere('State', 'translated')->get();

        return view('translate.bulk', compact('contest', 'artworks'));
    }

    public function SaveTranslation(Artwork $artwork)
    {
        // dd(request()->en);
        $artwork->fill([
            'en'=> request()->en,
            'es'=> request()->es,
        ]);
        $artwork->state = 'translated';
        $artwork->save();

        return $artwork;
    }

    //
}
