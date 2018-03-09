<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User.
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'country',
        'phone',
        'avatar_path',
        'referred',
        'subscribed',
        'language',
        'email',
        'password',
        'confirmation_token',
    ];
    /**
     * @var array
     */
    protected $casts = [
        'subscribed' => 'boolean',
        'confirmed'  => 'boolean',
    ];
    /**
     * @var array
     */
    protected $administratorsEmails = [
        'jorgelsaud@gmail.com',
    ];
    /**
     * @var array
     */
    protected $judgesEmails = [
        'jorgelsaud+judge@gmail.com',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     *Check if user is Admin.
     */
    public function isAdmin()
    {
        return in_array($this->email, $this->administratorsEmails);
    }

    /**
     * @return bool
     */
    public function isJudge()
    {
        return in_array($this->email, $this->administratorsEmails);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contestants()
    {
        return $this->hasMany(Contestant::class, 'representant_id');
    }

    /**
     * Get the path to the user's avatar.
     *
     * @param string $avatar
     *
     * @return string
     */
    public function getAvatarPathAttribute($avatar)
    {
        return  asset($avatar ?: 'images/avatars/default.svg');
    }

    public function confirm()
    {
        $this->confirmed = true;
        $this->confirmation_token = null;
        $this->save();
    }

    public function roles()
    {
        return  $this->belongsToMany(Role::class);
    }
}
