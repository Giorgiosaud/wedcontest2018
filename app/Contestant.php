<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Contestant
 * @package App
 */
class Contestant extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function representant(){
        return $this->belongsTo(User::Class,'representant_id');
    }
}
