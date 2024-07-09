<?php

namespace App\Http\Resources;

use App\Models\Size;
use App\Models\Color;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        

        return [
           
          
            
        
            'rating' => $this->rating,
            'review' => $this->review,
          
  
        ];
    }
}