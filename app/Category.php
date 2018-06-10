<?php

namespace App;

use App\Contestant;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category.
 */
class Category extends Model
{
    protected $fillable = ['name', 'max_age', 'contest_id'];

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope('sorted', function ($builder) {
            $builder->orderBy('max_age', 'asc');
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contest()
    {
        return $this->belongsTo(Contest::class);
    }
    public function contestants(){
        return $this->belongsToMany(Contestant::class)->withPivot('status');

    }
}
