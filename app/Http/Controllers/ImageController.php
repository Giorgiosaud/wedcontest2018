<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store()
    {
        request()->validate([
            'image' => ['required'],
        ]);
        $data = request()->file('image')->store('temp', 'public');
        return response(compact('data'), 201);

    }
}
// 