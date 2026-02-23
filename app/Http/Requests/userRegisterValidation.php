<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userRegisterValidation extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'A name is absolutely required.',
            'email.required' => 'Email is required.',
            'email.unique' => 'This email has already been used.',
            'password.required' => 'Password is required.',
            'password.min' => 'Your password must be at least 6 characters.',
        ];
    }
}
