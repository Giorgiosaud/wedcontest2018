<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Contest
 * @package App
 */
class Contest extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'topic',
        'description',
        'slug',
        'year'
    ];

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
        return '/contests/' . $this->slug;
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator(){
        return $this->belongsTo(User::class,'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
