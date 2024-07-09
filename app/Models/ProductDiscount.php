<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDiscount extends Model
{
    use HasFactory;
    protected $table="product_discount";
    protected  $guarded=[];
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    protected $casts=[
        'special_price_end'=>'datetime',
        'special_price_start'=>'datetime',

    ];
}
