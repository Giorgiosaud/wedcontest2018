<?php

namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Contest.
 */
class Contest extends Model
{
    use Translatable;
    public $translatedAttributes = ['topic', 'description','seo_message','logo_image'];

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'slug',
        'year',
    ];
    protected $appends = [
        'path',
        'background_image',
    ];
    protected $with = ['translations'];

    /**
     * Get the route key name.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
    /**
     * @return string
     */
    public function path()
    {
        return '/contest/'.$this->slug;
    }

    public function getPathAttribute()
    {
        return $this->path();
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    /**
     * @param string $avatar
     *
     * @return string
     */
    public function getBackgroundImageAttribute($background_image)
    {
        if($background_image){
           return asset("/storage/".$background_image);
       }
       return asset('images/Home/ContestIntro.jpg');
   }
}
