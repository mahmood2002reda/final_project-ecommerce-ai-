<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use CyrildeWit\EloquentViewable\Contracts\Viewable;

class Product extends Model implements Viewable
{
    use HasFactory;
    use InteractsWithViews;

    protected $fillable = [
        'slug',
        'name',
        'description',
        'price',
        'quantity',
        'sku',
        'manage_stock',
        'is_available',
        'image',
        'qty',
        'in_stock',
        'category_id',
        'brand_id',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_product', 'product_id', 'user_id');
    }

    public function cart()
    {
        return $this->hasMany(ShoppingCart::class);
    }

    public function product_images()
    {
        return $this->hasMany(ProductImages::class, 'product_id', 'id');
    }

    public function options()
    {
        return $this->belongsToMany(Option::class, 'option_product')
            ->select('options.id', 'options.color', 'options.size') 
            ->withPivot('extra_price', 'quantity');
    }
 /*   public function option_products()
{
    return $this->hasMany(OptionProduct::class);
}*/
public function productOptions()
{
    return $this->hasMany(ProductOption::class);
}
public function myPaurchases()
{
    return $this->hasMany(ProductOption::class);
}
}