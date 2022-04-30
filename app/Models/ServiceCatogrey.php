<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCatogrey extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'servicescatogries';


     /**
     * Get the cities for the State.
     */
    public function specializations()
    {
        return $this->hasMany(Specialization::class,'serviceCatogrey_id');
    }



}
