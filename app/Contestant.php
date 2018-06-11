<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
    ];
    protected $with = ['category'];

    public function category()
    {
        return $this->belongsToMany(Category::class)->withPivot('status');
    }

    public function representant()
    {
        return $this->belongsTo(User::class, 'representant_id');
    }

    public function contest()
    {
        return $this->hasManyThrough(\App\Contest::class, \App\Category::class);
    }
    /**
     * @return string
     */
    public function editPath()
    {
        if(auth()->user()){
            return route('mycontestant.edit',$this->id);
        }
        return route('contestant.edit',$this->id);
    }

    public function getEditPathAttribute()
    {
        return $this->editPath();
    }
}
