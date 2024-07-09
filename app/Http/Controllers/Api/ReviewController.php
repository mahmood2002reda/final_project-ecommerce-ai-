<?php

namespace App\Http\Controllers\Api;

use Request;
use App\Models\Review;
use App\Models\Product;
use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateReviewRequest;
use App\Http\Requests\Api\StoreReviewRequest ;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request, $id)
    {
        
        $review = Review::create($request->all());
        return ApiResponse::sendResponse(201,$review);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreReviewRequest $request, $reviewId, $productId)
    {
        $review = Review::findOrFail($reviewId);
        $review->update($request->all());
    
        return ApiResponse::sendResponse(201, $review);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($reviewId,$prodctId)
    {
        $review = Review::findOrFail($reviewId);
        $review->delete();
    
        return ApiResponse::sendResponse(200, "Review deleted successfully");
    }
}
