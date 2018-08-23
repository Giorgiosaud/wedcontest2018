<?php

namespace App\Http\Controllers;

use App\Category;

class QuestionsApiController extends Controller
{
    public function get(Category $category)
    {
        return $category->questions;
    }

    public function post()
    {
        $user = auth()->user();
        dd($user);
    }

    //
}
