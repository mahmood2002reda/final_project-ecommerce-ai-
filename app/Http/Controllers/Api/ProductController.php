<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function category($product)
    {
        $category = Category::where('name', $product)->first();

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
    
} 