<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyPurchases extends Model
{
    use HasFactory;
    protected $table="my_purchases";
    protected $fillable = [
        'user_id',
        'product_id',
        'qty',
        'price'
        ];
        public function product()
{
    return $this->belongsTo(Product::class);
}
}
