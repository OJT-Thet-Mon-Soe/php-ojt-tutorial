<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        return Student::with("major")->get();
    }

    public function map($student): array
    {
        return [
            $student->id,
            $student->name,
            $student->major->name,
            $student->phone,
            $student->email,
            $student->address,
        ];
    }

    public function headings(): array
    {
        return ["Id", 'Name', 'Major', 'Phone', 'Email', 'Address'];
    }
}
