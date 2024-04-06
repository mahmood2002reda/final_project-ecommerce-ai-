<?php

namespace App\Http\Resources;

use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailsResource extends JsonResource
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
                'user' => [
                    'id' => $review->user->id,
                    'name' => $review->user->name,
                    'image' => url('images/profile/'.$review->user->profile->image_profile),
                    // Add other user details as needed
                ],
                
            ];
        });
        $colors = $this->productOptions->pluck('color_id')->unique()->toArray();
        $sizes = $this->productOptions->pluck('size_id')->unique()->toArray();

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'is_available' => $this->is_available,
            'images' =>$this->product_images->map(function($image) {
               return url('images/product/'.$image->images);
            }),
            'category_id' => $this->category_id,
            'vendor_id' => $this->vendor_id,
            'category_name' => $this->category->name,
            'colors' => Color::whereIn('id', $colors)->pluck('color')->toArray(),

        'sizes' => Size::whereIn('id', $sizes)->pluck('size')->toArray(),
            'reviews' => $productReviews->toArray(),
        ];
    }
}
