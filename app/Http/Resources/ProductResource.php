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
            'price'=>$this->price,
            'quantity'=>$this->quantity,
            'is_available'=>$this->is_available,
            'image'=>url('images/profile/'.$this->image),
            'category_id'=>$this->category_id,
            'vendor_id'=>$this->vendor_id,
            'category name'=>$this->category->name
            
            
        ];
    }
}
