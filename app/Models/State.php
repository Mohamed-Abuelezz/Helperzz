<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'states';



    /**
     * Get the country that owns the State.
     */
    public function country()
    {
        return $this->belongsTo(Country::class,'country_id');
    }

    

     /**
     * Get the cities for the State.
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }

        /**
     * Get the serviceProvider for the Country.
     */
    public function serviceProvider()
    {
        return $this->hasMany(ServiceProvider::class);
    }
}
