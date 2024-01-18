<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => 'required|string|min:4',
            'email' => 'required|unique:users',
            'phone_number' => 'required|string|min:1|unique:users',
            'password' => 'required|min:1',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
