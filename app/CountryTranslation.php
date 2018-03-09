<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CountryTranslation.
 */
class CountryTranslation extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['name'];
}
