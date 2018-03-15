<?php

namespace App\Http\Controllers;

use App\Contest;
use Illuminate\Http\Request;

class ContestsController extends Controller
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

        if (request()->wantsJson()) {
            return $contests;
        }

        return view('contests.index', [
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
    public function store(Request $request)
    {
        request()->validate([
                'topic'       => 'required',
                'slug'        => 'required',
                'description' => 'required',
                'year'        => 'required',
                ]);
        request()->offsetSet('user_id', auth()->id());
        $contest = Contest::create($request->all());
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
        //
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
