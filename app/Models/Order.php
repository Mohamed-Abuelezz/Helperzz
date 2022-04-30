<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


        /* The table associated with the model.
    *
    * @var string
    */
   protected $table = 'orders';



       /**
     * Get the user that owns the orders.
     */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


       /**
     * Get the user that owns the orders.
     */
    public function provider()
    {
        return $this->belongsTo(ServiceProvider::class,'serviceProvider_id');
    }


           /**
     * Get the user that owns the orders.
     */
    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class,'ordersStatus_id');
    }

}
