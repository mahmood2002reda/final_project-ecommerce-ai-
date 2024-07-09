<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

     
     public function toArray($request): array
     {
         $productReviews = $this->reviews->map(function ($review) {
             return [
                 'rating' => $review->rating,
                 'review' => $review->review,
                 
                 
             ];
         });
 
         return [
            
            'product'=>[
             'id' => $this->id,
             'name' => $this->name,
             'description' => $this->description,
             'original_price' => $this->original_price,
           
             
             'images' => $this->product_images->map(function($image) {
                 return url('images/product/'.$image->image);
             }),
           
         'views'=>$this->views ,
             'reviews' => $productReviews->toArray(),
         ]];
     }
}
