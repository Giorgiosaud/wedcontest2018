<?php

namespace App\Http\Controllers;

use App\Artwork;
use App\Category;
use App\Contest;
use App\User;
use Illuminate\Support\Facades\Auth;

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
    public function get(Category $category,User $user)
    {
        $artworks = Artwork::whereCategoryId($category->id)->whereState('translated')->with(['answers'=> function($query) use ($user)
        {
            $query->where('answers.user_id', $user->id);
       },'category.questions'])->get();

return $artworks;
}
}
