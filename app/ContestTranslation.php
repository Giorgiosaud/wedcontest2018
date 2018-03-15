<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContestTranslation extends Model
{

    public $timestamps = false;
    protected $fillable = ['topic','description',];
    //
}
