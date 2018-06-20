<?php

namespace App\Http\Controllers;

use App\Artwork;
use App\Contest;
use App\Contestant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ArtworkUploadController extends Controller
{
	public function create(Contestant $contestant){

		$this->authorize('createArtwork', $contestant);
        if($contestant->hasArtworkForThisYear){
            return redirect()->route('artwork.edit',$contestant->slug);
        }

        return view('artwork.create', [
         'contestant' => $contestant,
     ]);
    }
    public function store(Contestant $contestant){
        $this->authorize('createArtwork', $contestant);
        request()->validate([
            'url'             => 'required',
            'title'             => 'required',
            'explenation'         => 'required',
        ]);

        $name=str_slug(request('title'));
        $contest=Contest::whereActive(1)->first();
        $activeContestCatIds=$contest->categories->pluck('id');
        $activeContestantCatIds=$contestant->categories->pluck('id');
        $catId=$activeContestCatIds->intersect($activeContestantCatIds)->first();
        $artworkFile=$contest->slug.'/'.$contestant->slug.'/'.$name.'.jpg';
        if (Storage::exists($artworkFile)) {
            Storage::delete($artworkFile);
        }
        $file=Storage::disk('public')->move(request('url'), $artworkFile);

        // $url=asset($contest->slug.'/'.$contestant->slug.'/'.$name.'.jpg');
        $artwork = Artwork::create([
            'contestant_id' => $contestant->id,
            'category_id' => $catId,
            'url'    => $artworkFile,
            'en'=>[
            	'title'=>request('title'),
            	'description'=>request('explenation'),
            ],
            'es'=>[
            	'title'=>request('title'),
            	'description'=>request('explenation'),
            ],
        ]);

        return redirect()->route('artwork.review',[$contestant->slug,$artwork->id]);
    }
    public function review(Contestant $contestant, Artwork $artwork){
        return view('artwork.show',compact('contestant','artwork'));
    }
    public function edit(Contestant $contestant){
        $actualContest=Contest::whereActive(true)->first();
        $cats=$actualContest->categories->pluck('id')->toArray();
        $artwork=$contestant->artworks->whereIn('category_id', $cats)->first();
        return view('artwork.edit',compact('contestant','artwork'));
    }
    public function update(Contestant $contestant){
        $this->authorize('createArtwork', $contestant);
        request()->validate([
            'url'             => 'required',
            'title'             => 'required',
            'description'         => 'required',
        ]);
        $artwork=$contestant->activeArtwork;
        $name=str_slug(request('title'));
        $contest=Contest::whereActive(1)->first();
        $activeContestCatIds=$contest->categories->pluck('id');
        $activeContestantCatIds=$contestant->categories->pluck('id');
        $catId=$activeContestCatIds->intersect($activeContestantCatIds)->first();
        $artworkFile=$contest->slug.'/'.$contestant->slug.'/'.$name.'.jpg';
        if(request('url')!==$artworkFile);
        {
            if (Storage::disk('public')->exists($artworkFile)) {
                Storage::disk('public')->delete($artworkFile);
            }
            $file=Storage::disk('public')->move(request('url'), $artworkFile);
        }
        $artwork->update([
            'url'    => $artworkFile,
            'en'=>[
                'title'=>request('title'),
                'description'=>request('description'),
            ],
            'es'=>[
                'title'=>request('title'),
                'description'=>request('description'),
            ],
        ]);
        return ['data'=>route('artwork.review',[$contestant->slug,$artwork->id])];
    }
    
    


}
