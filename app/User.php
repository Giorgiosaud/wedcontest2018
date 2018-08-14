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
        'referred_specify',
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
    protected $appends = ['isAdmin'];

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
        return $this->roles->pluck('name')->contains('Administrator');
    }
    /**
     *Check if user is Admin.
     */
    public function getisAdminAttribute()
    {
        return $this->roles->pluck('name')->contains('Administrator');
    }

    /**
     * @return bool
     */
    public function isJudge()
    {
        return $this->roles->pluck('name')->contains('Judge');
    }

    /**
     * [representant description].
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function representant()
    {
        return $this->belongsTo(self::class, 'representant_id');
    }

    /**
     * [contestants description].
     *
     * @return [USer] [description]
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

    /**
     * [confirm description].
     *
     * @return [User] [description]
     */
    public function confirm()
    {
        $this->confirmed = true;
        $this->confirmation_token = null;
        $this->save();
    }

    /**
     * [roles description].
     *
     * @return [User] [description]
     */
    public function roles()
    {
        return  $this->belongsToMany(Role::class);
    }

    public function getFlagAttribute()
    {
        return asset('/images/flags/'.$this->country.'.png');
    }

    /**
     * [setRole description].
     *
     * @param [string] $role [description]
     */
    public function setRole($role)
    {
        if (Role::whereName($role)->exists()) {
            $role = Role::whereName($role)->first();

            return $this->roles()->attach($role->id);
        }

        throw new \Exception('Role not Exist');
    }

    public function countryData()
    {
        return $this->belongsTo(Country::class, 'country', 'code');
    }
}
