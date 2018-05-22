<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contestant extends Model
{
    protected $fillable = [
        'representant_id',
        'name',
        'last_name',
        'dob',
        'motivo',
    ];
    protected $with = ['category'];

    public function category()
    {
        return $this->belongsToMany(Category::class)->withPivot('status');
    }

    public function contest()
    {
        return $this->hasManyThrough(\App\Contest::class, \App\Category::class);
    }
}
