<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportProfile extends Model
{
    use HasFactory;


    /* The table associated with the model.
    *
    * @var string
    */
    protected $table = 'reportsprofiles';

    /**
     * Get the user that owns the reportsProfiles.
     */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    /**
     * Get the serviceProvider that owns the reportsProfiles.
     */
    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class,'serviceProvider_id');
    }
}
