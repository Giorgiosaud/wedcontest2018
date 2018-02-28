<?php

namespace App\Http\Controllers;

use App\Contest;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Contest $contest){
        return $contest->categories;
    }
}
