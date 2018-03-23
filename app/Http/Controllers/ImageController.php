<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store()
    {
        request()->validate([
            'file' => ['required', 'image', 'max:5000'],
        ]);
        $filename = request()->file('file')->store('contests', 'public');

        return response(['data' => $filename], 204);
    }
}
