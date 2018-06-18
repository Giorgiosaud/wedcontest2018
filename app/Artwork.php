<?php

namespace App;

use App\Category;
use App\Contestant;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    use Translatable;
    public $translatedAttributes = ['title', 'description'];
    protected $fillable = ['url','contestant_id','category_id'];
    protected $appends=['imageLink'];
    protected $with = ['translations'];
    public function pathReview()
    {
        return route('artwork.review',[ $this->contestant->slug,$this->id]);
    }

    public function getPathReviewAttribute()
    {
        return $this->pathReview();
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
    
    public function contestant(){
        return $this->belongsTo(Contestant::class);
    }
    public function getImageLinkAttribute(){
        return asset('/'.$this->url);
    }
    public function getUpdatePathAttribute(){
        return $this->updatePath;
    }
    
    public function updatePath(){
        return route('artwork.update', $this->contestant->slug);
    }
    
    
     //
}
