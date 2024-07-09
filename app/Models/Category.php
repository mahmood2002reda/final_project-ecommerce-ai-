<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @method static \Database\Factories\CategoryFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    use HasFactory;
  //  protected $fillable = ['name', 'description','parent_id'];
    protected $table='categories';
    protected $fillable=[
           'name',
            'slug',
              'active',
              'description',
              'meta_title',
              'meta_keyword',
              'meta_description',
              'image',


    ];


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($category) {
            // Delete associated products
            $category->products()->each(function ($product) {
                $product->delete();
            });

            // Detach associated products
            $category->products()->detach();
        });
    }

//     $category = Category::find($category_id);
// $softDeletedProducts = $category->products()->withTrashed()->get();

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }


    // public function products()
    // {
    //     return $this->hasMany(Product::class);
    // }

    public function products()
    {
        return $this->belongsToMany(Product::class,'product_category');
    }


//     public function subcategories()
// {
//     return $this->hasMany(Category::class, 'parent_id');
// }
//     public function products()
//     {
//         return $this->hasMany(Product::class);
//     }
}
