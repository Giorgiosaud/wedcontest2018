<?php

namespace App\Http\Controllers;

use App\Country;

class CountriesController extends Controller
{
    public function index()
    {
        return Country::all();
    }

    //
}
