<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'quantity', 'is_available', 'image'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}