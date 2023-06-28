<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MajorCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "name" => "required|unique:majors",
        ];
    }
}
