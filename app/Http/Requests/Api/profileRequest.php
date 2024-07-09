<?php

namespace App\Http\Requests\Api;

use App\Helpers\ApiResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class profileRequest extends FormRequest
{
    
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    protected function failedValidation(Validator $validator)
    {
        if ($this->is('api/*')) {
            $response = ApiResponse::sendResponse(422, 'Validation errors', $validator->errors()->all());
            throw new \Illuminate\Validation\ValidationException($validator, $response);
        }
    
        parent::failedValidation($validator);
    }
    
        
    
      public function rules(): array
    {
        return [
            
                'image_profile' => 'required',
                'mobile_number1' => 'required|numeric',
                'mobile_number2' => 'required|numeric',
                'street_address' => 'required',
                'city' => 'required',
                'state' => 'required',
        
            
        ];

    }
    
}
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
  

