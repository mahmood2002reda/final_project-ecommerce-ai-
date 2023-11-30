<?php

namespace App\Http\Resources;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
{
    $addresses = $this->profile->addresses->map(function ($address) {
        return [
            'street_address' => $address->street_address,
            'city' => $address->city,
            'state' => $address->state,
        ];
    });

    return [
        'name' => $this->name,
        'email' => $this->email,
        'image_profile' => url('app/public/images/' . $this->profile->image_profile),
        'mobile_number1' => $this->profile->mobile_number1,
        'mobile_number2' => $this->profile->mobile_number2,
        'addresses' => $addresses,
    ];
}
}
