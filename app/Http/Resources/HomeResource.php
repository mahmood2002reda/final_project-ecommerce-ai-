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
             'id' => $this->id,
             'name' => $this->name,
            
             'price' => $this->price,
           
             
             'images' => $this->product_images->map(function($image) {
                 return url('images/profile/'.$image->images);
             }),
           
         'views'=>$this->views ,
             'reviews' => $productReviews->toArray(),
         ];
     }
}
