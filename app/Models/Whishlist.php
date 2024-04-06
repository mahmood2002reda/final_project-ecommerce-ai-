<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whishlist extends Model
{
    use HasFactory;
    protected $table = 'user_product';

    protected $fillable = [
        'user_id',
        'product_id',
        'password',
    ];
    public function product(){
        return $this->hasMany(Product::class);

    }
}
