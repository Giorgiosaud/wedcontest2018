<?php

namespace App\Http\Controllers;

use App\Contest;

class MyContestants extends Controller
{
    public function create()
    {
        $categories = Contest::whereActive('1')->get()->first()->categories()->get();

        return view('contestants.create', [
            'categories' => $categories,
        ]);
    }

    //
}
