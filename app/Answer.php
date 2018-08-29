<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['user_id', 'artwork_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRespuestasAttribute()
    {
        return json_decode($this->answers);
    }

    //
}
