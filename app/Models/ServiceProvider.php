<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Database\Factories\UserFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ServiceProvider extends Authenticatable  implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    


    /* The table associated with the model.
    *
    * @var string
    */
   protected $table = 'serviceproviders';
   protected $guarded = array();

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

   protected $appends = ['average_rate'];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the country that owns the serviceProviders.
     */
    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }

    /**
     * Get the State that owns the serviceProviders.
     */
    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    }

        /**
     * Get the City that owns the serviceProviders.
     */
    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }


        /**
     * Get the specialization that owns the serviceProviders.
     */
    public function specialization()
    {
        return $this->belongsTo(Specialization::class,'specialization_id');
    }

        /**
     * Get the specialization that owns the serviceProviders.
     */
    public function serviceCatogrey()
    {
        return $this->belongsTo(ServiceCatogrey::class,'serviceCatogrey_id');
    }


    public function moreservicesofserviceproviders()
    {
        return $this->hasMany(MoreServiceOfServiceProvider::class,'serviceProvider_id');
    }


             /**
     * Get the cities for the State.
     */
    public function rates()
    {
        return $this->hasMany(Rate::class,'serviceProvider_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'serviceProvider_id');
    }

    public function getAverageRateAttribute()
    {
        return $this->attributes['average_rate'] = $this->rates->avg('rate');
    }

}
