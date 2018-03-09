<?php

namespace App\Http\Controllers;

use App\Contest;

class CategoriesController extends Controller
{
    public function index(Contest $contest)
    {
        return $contest->categories;
    }
}
