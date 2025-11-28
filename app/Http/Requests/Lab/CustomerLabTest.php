<?php

namespace App\Http\Requests\Lab;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Traits\ApiResponseTrait;

class CustomerLabTest extends FormRequest
{
    use ApiResponseTrait;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'laboratory' => 'required',
            'test_id' => 'required',
            'patientId' => 'required',
            'testDate' => 'required',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->validationErrorResponse($validator->errors())
        );
    }
}
