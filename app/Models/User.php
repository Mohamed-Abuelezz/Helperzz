<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Database\Factories\UserFactory;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'last_seen'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];





    /**
     * Get the country that owns the User.
     */
    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }

    /**
     * Get the State that owns the User.
     */
    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    }

        /**
     * Get the City that owns the User.
     */
    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }

        /**
     * Get the country that owns the User.
     */
    public function gender()
    {
        return $this->belongsTo(Gender::class,'gender_id');
    }

}
