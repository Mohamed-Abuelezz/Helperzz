<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'countries';




    /**
     * Get the states for the Country.
     */
    public function states()
    {
        return $this->hasMany(State::class);
    }


    /**
     * Get the users for the Country.
     */
    public function user()
    {
        return $this->hasMany(User::class);
    }
    /**
     * Get the serviceProvider for the Country.
     */
    public function serviceProvider()
    {
        return $this->hasMany(ServiceProvider::class);
    }
    
}
