<?php

namespace App\Http\Controllers;

use App\Contest;
use Illuminate\Http\Request;

class MyContestants extends Controller
{
    public function index()
    {
        $contestants = auth()->user()->contestants;
        return view('contestants.index', [
            'contestants' => $contestants,
        ]);
    }
    public function create()
    {
        $categories = Contest::whereActive('1')->get()->first()->categories()->get();

        return view('contestants.create', [
            'categories' => $categories,
        ]);
    }
    public function store(Request $request)
    {
        $contestant = [
            'representant_id' => auth()->user()->id,
            'name' => $request->name,
            'last_name' => $request->last_name,
            'dob' => $request->dob
        ];
        Contestant::create($contestant);

    }

    //
}
