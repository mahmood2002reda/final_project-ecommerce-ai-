<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'=>$this->id,
            'name'=>$this->name,
            'description'=>$this->description,
            'original_price'=>$this->original_price,
            'quantity'=>$this->quantity,
            'is_available'=>$this->is_available,
            'images' =>$this->product_images->map(function($image) {
                return url('images/product/'.$image->image);
             }),           'category_id'=>$this->category_id,
             'categories' => $this->categories->map(function($category) {
                return $category->name;}),
                'categories_id' => $this->categories->map(function($category) {
                    return $category->id;
                }),
           // 'vendor_id'=>$this->vendor_id,
          //  'category name'=>$this->category->name
            
            
        ];
    }
}
