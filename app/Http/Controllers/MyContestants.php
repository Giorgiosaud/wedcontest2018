<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyContestants extends Controller
{
    public function create()
    {
        return view('contestants.create');
    }
    //
}
