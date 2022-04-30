<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportComment extends Model
{
    use HasFactory;

    /* The table associated with the model.
    *
    * @var string
    */
   protected $table = 'reportscomments';




    /**
     * Get the serviceProvider that owns the ReportComment.
     */
    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class,'serviceProvider_id');
    }


        /**
     * Get the serviceProvider that owns the comment.
     */
    public function comment()
    {
        return $this->belongsTo(Comment::class,'comment_id');
    }
   
}
