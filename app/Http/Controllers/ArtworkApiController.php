<?php

namespace App\Http\Controllers;

use App\Artwork;
use App\Contest;

class ArtworkApiController extends Controller
{
    public function index()
    {
        $activeContest = Contest::whereActive(true)->first();
        $catsId = $activeContest->categories->pluck('id');
        $artworks = Artwork::whereIn('category_id', $catsId)->whereState('approved')->get();

        return $artworks;
    }

    public function show(Contest $contest)
    {
        $contest->load('categories.artworks')->get();
        $catsId = $contest->categories->pluck('id');
        $artworks = Artwork::whereIn('category_id', $catsId)->whereState('translated')->get();

        return $artworks;
    }
}
