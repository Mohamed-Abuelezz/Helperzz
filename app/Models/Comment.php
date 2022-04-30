<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments';


    /**
     * Get the user that owns the Comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    /**
     * Get the serviceProvider that owns the Comment.
     */
    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class,'serviceProvider_id');
    }


}
