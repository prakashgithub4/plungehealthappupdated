<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\ApiResponseTrait; 

class MobileVerifyRequest extends FormRequest
{
    use ApiResponseTrait;
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'country_code' => 'required|string|max:5',   
            'phone'        => 'required|digits_between:7,15', 
        ];
    }

    public function messages()
    {
        return [
            'country_code.required' => 'Country code is required.',
            'phone.required'        => 'Phone number is required.',
            'phone.digits_between'  => 'Phone number must be between 7–15 digits.',
        ];
    }
     protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->validationErrorResponse($validator->errors())
        );
    }
}
