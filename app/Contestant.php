<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Contestant.
 */
class Contestant extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function representant()
    {
        return $this->belongsTo(User::class, 'representant_id');
    }
}
