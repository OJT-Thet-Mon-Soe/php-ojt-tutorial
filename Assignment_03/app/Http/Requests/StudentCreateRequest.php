<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => "required",
            "majorId" => 'required',
            "phone" => "required|digits:11|regex:/^09\d{9}$/",
            "email" => "required|unique:students",
            "address" => "required",
        ];
    }
}
