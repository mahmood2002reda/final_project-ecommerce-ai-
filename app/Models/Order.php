<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable=[
        'user_id',
        'tracking_no',
        'fullname',
        'email',
        'pincode',
        'address',
        'status_message',
        'payment_mode',
        'payment_id',




    ];
// protected $fillable =[
// 'firstname',
// "lastname',
// 'phone',
// 'email',
// 'address',
// 'city',
// 'state',
// 'zipcode",
// 'payment_id',
// 'payment_mode',
// 'tracking_no',
// 'status',
// 'remark'];

// public function orderitems(){
//     return $this->hasMany(orderitems::class,'order_id','id');
// }

  /**
     * Get all of the comments for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(Orderitem::class,'order_id','id');
    }

}
