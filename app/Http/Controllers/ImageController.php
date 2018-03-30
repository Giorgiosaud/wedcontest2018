<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store()
    {
        request()->validate([
            'avatar' => ['required'],
        ]);
        $filename = request()->file('avatar')->store('contests', 'public');

        dd($filename)
            return response(['data' => $filename], 204);
    }
}
// 