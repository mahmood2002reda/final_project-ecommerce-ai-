<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $table = 'shopping_cart';

    protected $fillable = [
        'user_id',
        'product_id',
        'product_qty',
        'extra_price',
        'product_color',
        'product_size'

    ];
    public function product()
{
    return $this->belongsTo(Product::class);
}
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}