<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Product;
use App\Models\ProductOption;

class Orderitem extends Model
{
    use HasFactory;
    protected $table='orderitems';
    protected $fillable=[
        'order_id',
        'product_id',
        'product_color_id',
        'quantity',
        'price',

    ];


   /**
    * Get the product that owns the Orderitem
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function product(): BelongsTo
   {
       return $this->belongsTo(Product::class, 'product_id', 'id');
   }

    /**
    * Get the product color that owns the Orderitem
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function ProductOption(): BelongsTo
   {
       return $this->belongsTo(ProductOption::class, 'product_color_id', 'id');
   }
   public function order(){
        return $this->belongsTo(Order::class, 'order_id');
   }


}
