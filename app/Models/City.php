<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;


     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cities';


    /**
     * Get the state that owns the City.
     */
    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    }


    /**
     * Get the serviceProvider for the Country.
     */
    public function serviceProvider()
    {
        return $this->hasMany(ServiceProvider::class);
    }

}
