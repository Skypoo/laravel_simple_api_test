<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
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
            'Account' => 'required|string|max:50|exists:user,account',
            'Password' => 'required|string|max:50',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $result = [
            'Code' => 500,
            'Message' => $validator->errors()->toArray(),
        ];

        $response = response()->json($result, 422);

        throw new HttpResponseException($response);
    }
}
