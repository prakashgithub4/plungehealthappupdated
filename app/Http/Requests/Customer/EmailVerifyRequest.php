<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\ApiResponseTrait;

class EmailVerifyRequest extends FormRequest
{
    use ApiResponseTrait;

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'   => 'required|email|max:255',
            'temp_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            // Email
            'email.required' => 'Email is required.',
            'email.email'    => 'Email format is invalid.',
            'email.max'      => 'Email must not exceed 255 characters.',

            // OTP
            'otp.required' => 'OTP is required.',
            'otp.digits'   => 'OTP must be exactly 6 digits.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->validationErrorResponse($validator->errors())
        );
    }
}
