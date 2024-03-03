<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\Category;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\HomeResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductDetailsResource;
use App\Models\User;
use Auth;
use CyrildeWit\EloquentViewable\Support\Period;



class ProductController extends Controller
{
    public function addWishlist($id){

        $userId=Auth::id();
        $productId=Product::find($id);
        $Stor= DB::table('user_product')->insert([
            'user_id' => $userId,
            'product_id' =>  $productId->id,]);


    }

    public function myWishlist()
{
    $userId = Auth::id();

    $products = DB::table('user_product')
        ->where('user_id', $userId)
        ->join('products', 'user_product.product_id', '=', 'products.id')
        ->select('products.*')
        ->get();

    return ApiResponse::sendResponse(200, 'Products Retrieved Successfully',$products);
}

public function mostView(){

    $mostReview = DB::table('products')
    ->orderBy('views', 'DESC')
    ->limit(5)
    ->get();
if(  $mostReview){

     
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

    $bestSeller = Product::select('products.*', DB::raw('COUNT(orderitems.product_id) AS total_sales'))
    ->join('orderitems', 'products.id', '=', 'orderitems.product_id')
    ->groupBy('products.id')
    ->orderBy('total_sales', 'DESC')
    ->limit(10)
    ->get();
    
if($bestSeller ){

      return ApiResponse::sendResponse(200, 'Products Retrieved Successfully',   HomeResource::collection($bestSeller));
            } else {
                return ApiResponse::sendResponse(200, 'No Products available', []);
            }
    }
    public function category($id)
    {
        $category = Category::where('id', $id)->first();

        if ($category) {
            $products = Product::where('category_id', $category->id)
                ->latest()
                ->paginate(3);

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
            $products->where('category_id', $category);
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
        }
    
        if ($product) {
            $product->increment('views');
            return response()->json([
                'product' => $product,
                'colors' => $colorArray,
                'sizes' => $sizeArray,
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