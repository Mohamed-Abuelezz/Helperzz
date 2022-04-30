<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoreService extends Model
{
    use HasFactory;


             /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'moreservices';


    /**
     * Get the country that owns the serviceProviders.
     */
    public function specialization()
    {
        return $this->belongsTo(Specialization::class,'specialization_id');
    }
    

}
