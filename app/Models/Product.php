<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;
use App\Models\ProductColor;
use App\Models\ProductOption;
use App\Models\Brand;
use Illuminate\Database\Eloquent\SoftDeletes;
//use CyrildeWit\EloquentViewable\InteractsWithViews;
//use CyrildeWit\EloquentViewable\Contracts\Viewable;
use DB;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $table= 'products';
    protected $fillable=[
             'category_id',
             'brand_id',
            'name',
             'slug',
             'sku',
             'small_description',
             'description',
             'original_price',
               'selling_price',
               'quantity',
               'trending',
               'active',
                'meta_title',
                'meta_keyword',
             'meta_description',
             'subcategory_id',
             'model_image',


    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }

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
        return $this->belongsToMany(User::class, 'user_product', 'product_id', 'user_id')->wherePivot([]);
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
    return $this->hasMany(MyPurchases::class);
}
public function wishlist()
{
    return $this->belongsTo(Whishlist::class, 'whishlist_id');
}
public function productImages(){
    return $this->hasMany(ProductImage::class,'product_id','id');
}

public function productColors(){

    return $this->hasMany(ProductColor::class,'product_id','id');

}


public function discount(){
    return $this->hasOne(ProductDiscount::class,'product_id');
}
}
