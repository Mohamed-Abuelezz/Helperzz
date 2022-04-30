<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;

         /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'specializations';



        /**
     * Get the categories that owns the Specialization.
     */
    public function category()
    {
        return $this->belongsTo(ServiceCatogrey::class,'serviceCatogrey_id');
    }

         /**
     * Get the cities for the State.
     */
    public function moreServices()
    {
        return $this->hasMany(MoreService::class,'specialization_id');
    }

}
