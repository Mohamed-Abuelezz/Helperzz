<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Admin extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use HasFactory;
    use Notifiable;


         /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admins';
    protected $guarded = array();




}
