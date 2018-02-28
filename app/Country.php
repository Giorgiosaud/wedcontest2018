<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Country
 * @package App
 */
class Country extends Model
{
    use Translatable;

    /**
     * @var array
     */
    public $translatedAttributes = ['name'];
    /**
     * @var array
     */
    protected $fillable = ['code','flag','calling_code'];
}
