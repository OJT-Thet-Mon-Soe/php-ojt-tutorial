<?php

namespace App\Imports;

use App\Models\Major;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentImport implements ToModel, WithHeadingRow, WithValidation
{
    use Importable;

    public function model(array $row)
    {
        $major = Major::where("name", $row["major"])->first();
        if (!empty($major)) {
            return new Student([
                'name' => $row["name"],
                'phone' => $row["phone"],
                'email' => $row["email"],
                'address' => $row["address"],
                'major_id' => $major->id
            ]);
        }
    }

    public function rules(): array
    {
        return [
            "*.email" => "required|unique:students",
        ];
    }
}
