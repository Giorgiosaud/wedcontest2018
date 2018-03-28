<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Country.
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
    protected $fillable = ['code', 'flag', 'calling_code'];

    protected $with=['translations'];
    
    public function getFlagAttribute($flag)
    {
        return asset('images/flags/'.$flag);
    }
}
