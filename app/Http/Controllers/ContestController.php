<?php

namespace App\Http\Controllers;

use App\Category;
use App\Contest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContestController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only(['store', 'update', 'create', 'edit', 'destroy']);
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contests = $this->getContests();
        $contest = Contest::whereActive('1')->get()->first();
        if (request()->wantsJson()) {
            return $contests;
        }
        return view('contests.index', [
            'contest'=>$contest,
            'contests' => $contests,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        request()->validate([
            'year'             => 'required|numeric',
            'slug'             => 'required|string',
            'en.topic'         => 'required|string',
            'en.logo_image'    => 'required|string',
            'en.description'   => 'required|string',
            'es.topic'         => 'required|string',
            'es.description'   => 'required|string',
            'es.logo_image'    => 'required|string',
            'background_image' => 'required|string',
            'normalCategories' => 'required|boolean',
        ]);
        // dd($contest);
        $contest = Contest::create([
            'user_id' => auth()->id(),
            'slug'=>request('slug'),
            'year'    => request('year'),
            'en'      => request('en'),
            'es'      => request('es'),
        ]);

        $files=[
            'public/contest/'.$contest->slug.'/backgroundImage.jpg',
            'public/contest/'.$contest->slug.'/esLogo.jpg',
            'public/contest/'.$contest->slug.'/enLogo.jpg'
        ];
        foreach($files as $file){
            if (Storage::exists($file)) {
                Storage::delete($file);
            }
        }
        Storage::move('public/'.request('background_image'), $files[0]);
        Storage::move('public/'.request('es')['logo_image'], $files[1]);
        Storage::move('public/'.request('en')['logo_image'], $files[2]);
        $contest->background_image = 'contest/'.$contest->slug.'/backgroundImage.jpg';
        $contest->translate('es')->logo_image = 'contest/'.$contest->slug.'/esLogo.jpg';
        $contest->translate('en')->logo_image = 'contest/'.$contest->slug.'/enLogo.jpg';
        $contest->save();
        if (request('normalCategories')) {
            $categories = [
                ['name' => 'Seeds', 'max_age' => 3, 'contest_id' => $contest->id],
                ['name' => 'Sprouts', 'max_age' => 7, 'contest_id' => $contest->id],
                ['name' => 'Thinkers', 'max_age' => 10, 'contest_id' => $contest->id],
                ['name' => 'Game Changers', 'max_age' => 15, 'contest_id' => $contest->id],
            ];
            foreach ($categories as $category) {
                Category::create($category);
            }
        }

        if (request()->wantsJson()) {
            return response($contest, 201);
        }
        return redirect($contest->path())
        ->with('flash', 'Your thread has been published!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Contest $contest
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Contest $contest)
    {
        if (request()->wantsJson()) {
            return $contest;
        }

        return view('contests.show', compact('contest'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Contest $contest
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Contest $contest)
    {
        // return 'editing';
        // dd($contest->intro_image);

        return view('contests.edit', compact('contest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Contest             $contest
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contest $contest)
    {
        $contest->update($request->toArray());
        if ($request->has('intro_image')) {
            $file = 'public/contest/'.$contest->slug.'.jpg';
            if (Storage::exists($file)) {
                Storage::delete($file);
            }
            Storage::move('public/'.request('intro_image'), $file);
            $contest->intro_image = 'contest/'.$contest->slug.'.jpg';
            $contest->save();
        }
        if (request()->wantsJson()) {
            return response($contest, 201);
        }

        return redirect($contest->path())
        ->with(' flash ', ' Your thread has been published!');
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Contest $contest
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contest $contest)
    {
        //
    }

    protected function getContests()
    {
        $threads = Contest::latest();

        return $threads->paginate(25);
    }
}
