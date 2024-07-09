<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        //user_id	product_id	review	rating	
        return [
            'rating'=>'required|integer|between:0,5',
            'user_id'=>'exists:products,id',
            'review'=>'required',
            'product_id' => 'required|exists:products,id'
        ];
    }
}
