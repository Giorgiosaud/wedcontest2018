<?php

namespace App\Http\Controllers;

use App\Contest;
use Illuminate\Http\Request;

class ArtworkUploadController extends Controller
{
	public function create(){
        $this->authorize('update', $reply);

		$categories = Contest::whereActive('1')->get()->first()->categories()->get();

		return view('artwork.create', [
			'categories' => $categories,
		]);
	}

}
