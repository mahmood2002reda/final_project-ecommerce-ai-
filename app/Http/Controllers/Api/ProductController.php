<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductDetailsResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use CyrildeWit\EloquentViewable\Support\Period;



class ProductController extends Controller
{
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
        $word = $request->input('search') ?? null;
    
        $products = Product::when($word, function ($query) use ($word) {
            $query->where('name', 'like', '%' . $word . '%');
        })->latest()->paginate(3);
    
        if ($products->count() > 0) {
            $data = [
                'records' => ProductResource::collection($products),
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
    }

    public function show_details(Product $product ,$id)
{

    $product = Product::with('reviews','user')->findOrFail($id);
    $product->increment('views');
    //$viewCount=views($product)->record();
    return ApiResponse::sendResponse(200, 'Product Retrieved Successfully', new ProductDetailsResource($product));
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