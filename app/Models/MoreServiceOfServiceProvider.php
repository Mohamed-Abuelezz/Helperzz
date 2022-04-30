<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoreServiceOfServiceProvider extends Model
{
    use HasFactory;


             /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'moreservicesofserviceproviders';



    public function moreService()
    {
        return $this->belongsTo(MoreService::class,'moreService_id');
    }


}
