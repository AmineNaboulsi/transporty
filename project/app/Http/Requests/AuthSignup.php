<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthSignup extends FormRequest
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
        return [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'account_type' => 'required|in:passenger,company',
        ];
    }

    /**
     * Text message validations
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Name required',
            'email.required' => 'Email required',
            'email.email' => 'Email Format not match',
            'password.required' => 'Email required',
            'account_type.required' => 'Choose first account type',
            'account_type.in' => 'invalid account type'
        ];
    }


    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = response()->json([
            'status' => false,
            'message' => $validator->errors()
        ], 422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
