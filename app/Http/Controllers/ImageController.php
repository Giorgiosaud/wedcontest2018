<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function _construct()
    {
        $this->middleware('admin')->only(['store']);
    }
    public function store()
    {
        return 'hola';
    }
    //
}
