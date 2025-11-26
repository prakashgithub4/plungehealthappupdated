<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\ApiResponseTrait;

class RegisterRequest extends FormRequest
{
    use ApiResponseTrait;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name'   => 'required|string|max:255',
            'last_name'    => 'required|string|max:255',
            'email'        => 'required|email|max:255|unique:customers,email',
            'country_code' => 'required|string|max:5',
            'phone_number' => 'required|digits_between:7,15',
            'gender_id'    => 'required',
        ];
    }

    public function messages()
    {
        return [
            // First Name
            'first_name.required' => 'First name is required.',
            'first_name.string'   => 'First name must be a string.',
            'first_name.max'      => 'First name may not be greater than 255 characters.',

            // Last Name
            'last_name.required' => 'Last name is required.',
            'last_name.string'   => 'Last name must be a string.',
            'last_name.max'      => 'Last name may not be greater than 255 characters.',

            // Email
            'email.required' => 'Email is required.',
            'email.email'    => 'Email format is invalid.',
            'email.max'      => 'Email may not be greater than 255 characters.',
            'email.unique'   => 'This email is already registered.',

            // Country Code
            'country_code.required' => 'Country code is required.',
            'country_code.string'   => 'Country code must be a string.',
            'country_code.max'      => 'Country code may not be greater than 5 characters.',

            // Phone
            'phone_number.required'        => 'Phone number is required.',
            'phone_number.digits_between'  => 'Phone number must be between 7 and 15 digits.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->validationErrorResponse($validator->errors())
        );
    }
}
