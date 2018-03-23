<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store()
    {
        request()->validate([
            'file' => ['required', 'image','max:5000']
        ]);
        $filename=request()->file('file')->store('contests', 'public');
        return response(['data' => $filename], 204);
    }
}
