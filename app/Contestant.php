<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Contestant extends Model
{
    protected $fillable = [
        'representant_id',
        'name',
        'email',
        'last_name',
        'dob',
        'motivo',

    ];
    protected $appends = [
        'editPath',
        'uploadPath',
        'deletePath',
        'activeCategory',
    ];
    protected $dates = [
        'dob',
    ];

    protected static function boot()
    {
        static::creating(function ($contestant) {
            $contestant->slug = $contestant->name.'_'.$contestant->last_name;
        });
        static::created(function ($contestant) {
            $contestant->update(['slug' => $contestant->name.'_'.$contestant->last_name]);
        });
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withPivot('status');
    }

    public function representant()
    {
        return $this->belongsTo(User::class, 'representant_id');
    }

    public function contest()
    {
        return $this->hasManyThrough(\App\Category::class, \App\Contest::class);
    }

    /**
     * @return string
     */
    public function editPath()
    {
        // if (auth()->user()->isAdmin) {
        //     return route('contestant.edit', $this->slug);
        // }
        return route('mycontestant.edit', $this->slug);
    }

    /**
     * @return string
     */
    public function uploadPath()
    {
        if (request()->wantsJson()) {
            return route('artwork.create', $this->slug);
        }
        if (auth()->user()->isAdmin) {
            return route('artwork.create', $this->slug);
        }

        return '#';
    }

    /**
     * @return string
     */
    public function deletePath()
    {
        if (request()->wantsJson()) {
            return route('contestant.destroy', $this->slug);
        }
        if (auth()->user()->isAdmin) {
            return route('contestant.destroy', $this->slug);
        }

        return route('mycontestant.destroy', $this->slug);
    }

    /**
     * Get the route key name.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getDeletePathAttribute()
    {
        return $this->deletePath();
    }

    public function getEditPathAttribute()
    {
        return $this->editPath();
    }

    public function getUploadPathAttribute()
    {
        return $this->uploadPath();
    }

    public function getContestStatusAttribute()
    {
        return $this->contest()->first()->slug;
    }

    public function getAgeAttribute()
    {
        $dt = Carbon::now();

        return $dt->diffInYears($this->dob);  // 1
    }

    public function getActiveCategoryAttribute()
    {
        if ($this->categories->count() > 0) {
            return $this->categories->last()->name;
        } else {
            return '';
        }
    }

    /**
     * Set the proper slug attribute.
     *
     * @param string $value
     */
    public function setSlugAttribute($value)
    {
        if (static::whereSlug($slug = str_slug($value))->exists()) {
            $slug = "{$slug}-{$this->id}";
        }
        $this->attributes['slug'] = $slug;
    }

    public function artworks()
    {
        return $this->hasMany(Artwork::class);
    }

    public function getActiveArtworkAttribute()
    {
        return 'cfscf';
    }

    public function getHasArtworkForThisYearAttribute()
    {
        $actualContest = Contest::whereActive(true)->first();
        $cats = $actualContest->categories->pluck('id')->toArray();
        $thisYearArtwork = $this->artworks->whereIn('category_id', $cats);
        if ($thisYearArtwork->count() === 0) {
            return false;
        }

        return true;
    }
}
