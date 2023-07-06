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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required",
            "email" => "required|unique:students",
            "phone" => "required|digits:11|regex:/^09\d{9}$/",
            "address" => "required",
            "password" => "required|min:8|max:15|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[@!#$%^&*]).*$/",
            "confirmPassword" => "required|same:password",
        ];
    }

    public function messages() : array
    {
        return [
            "phone.regex" => "Phone number must start 09",
            "password.regex" => "Password must contain (A-Z),(a-z),(0-9),(@!#$%^&*a)",
        ];
    }
}
