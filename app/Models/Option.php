<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;


    public function product()
    {
        return $this->belongsToMany(Product::class, 'option_product', 'option_id', 'product_id')
            ->withPivot('extra_price', 'quantity')
            ->withTimestamps();
    }
}
