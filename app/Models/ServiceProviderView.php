<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ServiceProviderView extends Model
{
    use HasFactory;


         /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'serviceprovidersviews';

    protected $appends = ['dayname'];


       /**
     * Get the user that owns the orders.
     */
    public function provider()
    {
        return $this->belongsTo(ServiceProvider::class,'serviceProvider_id');
    }

    public function getDayNameAttribute()
    {
        
     return $this->attributes['dayname'] = Carbon::parse($this->created_at->format('d M Y'))->dayName ;
    //  return $this->created_at;
    }

}
