<?php

namespace App\Http\Controllers\Api;


use App\Models\User;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\HomeResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ReviewResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductDetailsResource;
use CyrildeWit\EloquentViewable\Support\Period;



class ProductController extends Controller
{
    public function addWishlist($id) {
        $userId = Auth::id();
        $product = Product::find($id);
    
        if (!$product) {
            return ApiResponse::sendResponse(404, 'Product not found');
        }
    
        $exists = DB::table('user_product')
                    ->where('user_id', $userId)
                    ->where('product_id', $product->id)
                    ->exists();
    
        if ($exists) {
            return ApiResponse::sendResponse(200, 'Product is already in your wishlist');
        }
    
        DB::table('user_product')->insert([
            'user_id' => $userId,
            'product_id' => $product->id,
        ]);
    
        return ApiResponse::sendResponse(200, 'Product added to wishlist successfully');
    }
    public function deleteWishlist($id) {
        $userId = Auth::id();
        $productId = Product::find($id);
    
        if (!$productId) {
            return ApiResponse::sendResponse(404, 'Product not found');
        }
    
        $deleted = DB::table('user_product')
            ->where('user_id', $userId)
            ->where('product_id', $productId->id)
            ->delete();
    
        if ($deleted) {
            return ApiResponse::sendResponse(200, 'Product removed from wishlist successfully');
        } else {
            return ApiResponse::sendResponse(400, 'Failed to remove product from wishlist');
        }
    }
    
    public function offers()
    {
        $products = Product::join('product_discount', 'products.id', '=', 'product_discount.product_id')
        ->select('products.*', 'product_discount.*')
        ->get();
        return ApiResponse::sendResponse(200, 'Products Retrieved Successfully',HomeResource::collection($products));

   /* foreach ($products as $product) {
        // Access the product and discount details
        $productName = $product->name;
        $discount = $product->discount;
    
        // Perform further operations with the retrieved data
        // ...
*/
        
    }
    public function myWishlist()
{
    $userId = Auth::id();

    $products = DB::table('user_product')
        ->where('user_id', $userId)
        ->join('products', 'user_product.product_id', '=', 'products.id')
        ->select('products.*', 'products.name', 'products.original_price', 'products.model_image', 'products.id as product_id')
        ->get();

    if ($products->isEmpty()) {
        return response()->json([
            'status' => 200,
            'msg' => 'No Product available',
            'data' => []
        ]);
    }

    $wishlist = [];

    foreach ($products as $product) {
        $productImages = DB::table('product_images')->where('product_id', $product->product_id)->get();
        $images = $productImages->map(function ($image) {
            return url('images/product/' . $image->image);
        });

        $reviews = Review::where('product_id', $product->product_id)->get();

        $wishlist[] = [
            '$product'=>[
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'original_price' => $product->original_price,
            'images' => $images,
            'reviews' => ReviewResource::collection($reviews),
        ]];
    }

    return response()->json(ApiResponse::sendResponse(200, 'Products Retrieved Successfully', $wishlist));
}

public function mostView(){

    $mostReview = Product::orderBy('views', 'DESC')
    ->limit(5)
    ->get();
if($mostReview){

     
      return ApiResponse::sendResponse(200, 'Products Retrieved Successfully', HomeResource::collection($mostReview) );
            } else {
                return ApiResponse::sendResponse(200, 'No Products available', []);
            }
    
}
    public function bestSeller(){

/*SELECT *, COUNT(orderitems.product_id) AS total_sales
FROM products
INNER JOIN orderitems ON products.id = orderitems.product_id
GROUP BY products.id
ORDER BY total_sales DESC;

    */   

    $bestSeller = Product::select('products.*', DB::raw('COUNT(my_purchases.product_id) AS total_sales'))
    ->join('my_purchases', 'products.id', '=', 'my_purchases.product_id')
    ->groupBy('products.id')
    ->orderBy('total_sales', 'DESC')
    ->limit(20)
    ->get();
    
if($bestSeller ){

      return ApiResponse::sendResponse(200, 'Products Retrieved Successfully',   HomeResource::collection($bestSeller));
            } else {
                return ApiResponse::sendResponse(200, 'No Products available', []);
            }
    }
    public function category($id)
    {
        $category = Category::where('id', $id)->with('products')->first();

        if ($category) {
            $products = $category->products()->latest()->paginate(4);
            


            if ($products->count() > 0) {
                $data = [
                    'records' => ProductResource::collection($products),
                    'category name' => $category->name,
                    'pagination links' => [
                        'current page' => $products->currentPage(),
                        'per page' => $products->perPage(),
                        'total' => $products->total(),
                        'links' => [
                            'first' => $products->url(1),
                            'last' => $products->url($products->lastPage())
                        ]
                    ]
                ];
                return ApiResponse::sendResponse(200, 'Products Retrieved Successfully', $data);
            } else {
                return ApiResponse::sendResponse(200, 'No Products available', []);
            }
        } else {
            return ApiResponse::sendResponse(404, 'Category not found', []);
        }
    }
    public function search(Request $request) {
        $word = $request->input('searchName') ?? null;
        $category = $request->input('searchCategory') ?? null;
        $MinPrice = $request->input('MinPrice') ?? null;
        $MaxPrice = $request->input('MaxPrice') ?? null;
    
        $products = Product::query();
        
        if ($word) {
            $products->where('name', 'like', '%' . $word . '%');
        }
        
        if ($category) {
            $products->whereHas('categories', function ($query) use ($category) {
                $query->where('categories.name', $category);
            });
        }
        
        if ($MinPrice && $MaxPrice) {
            $products->whereBetween('price', [$MinPrice, $MaxPrice]);
        }
        
        $products = $products->latest()->paginate(3);
    
        if ($products->count() > 0) {
            $data = [
                'records' => ProductResource::collection($products),
                'pagination' => [
                    'current_page' => $products->currentPage(),
                    'per_page' => $products->perPage(),
                    'total' => $products->total(),
                    'links' => [
                        'first' => $products->url(1),
                        'last' => $products->url($products->lastPage())
                    ]
                ]
            ];
            return ApiResponse::sendResponse(200, 'Products Retrieved Successfully', $data);
        } else {
            return ApiResponse::sendResponse(200, 'No Products available', []);
        }
    }
    
    public function show_details($id)
    {
        $product = Product::find($id);
      /*  
        $colors = DB::table('product_options')
            ->select('colors.color')
            ->distinct()
            ->join('products', 'product_options.product_id', '=', 'products.id')
            ->join('colors', 'product_options.color_id', '=', 'colors.id')
            ->where('products.id', $id)
            ->get();
    
        $sizes = DB::table('product_options')
            ->select('sizes.size')
            ->distinct()
            ->join('products', 'product_options.product_id', '=', 'products.id')
            ->join('sizes', 'product_options.size_id', '=', 'sizes.id')
            ->where('products.id', $id)
            ->get();
    
        $colorArray = [];
        foreach ($colors as $color) {
            $colorArray[] = $color->color;
        }
    
        $sizeArray = [];
        foreach ($sizes as $size) {
            $sizeArray[] = $size->size;
        } */
    
        if ($product) {
            $product->increment('views');
            return response()->json([
                'product' => new ProductDetailsResource($product) ,
             
            ]);
        } else {
            return ApiResponse::sendResponse(200, 'No Product available', []);
        }
    }
public function show($id)
{
    $product = Product::findOrFail($id);
    $viewCount = $product
        ->views()
        ->period(Period::since(today()))
        ->count();

    // Return the view count as a response
    return response()->json(['view_count' => $viewCount]);
}
} 