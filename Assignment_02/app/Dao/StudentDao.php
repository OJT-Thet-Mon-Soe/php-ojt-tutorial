<?php

namespace App\Dao;

use App\Models\Major;
use App\Models\Student;
use App\Exports\StudentExport;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Contracts\Dao\StudentDaoInterface;

class StudentDao implements StudentDaoInterface
{
    public function getStudent(): object
    {
        return Student::get();
    }

    public function getMajor()
    {
        return Major::get();
    }

    public function storeStudent($request): void
    {
        $data = [
            "name" => $request->name,
            "phone" => $request->phone,
            "email" => $request->email,
            "address" => $request->address,
            "major_id" => $request->majorId,
        ];
        Student::create($data);
    }

    public function editStudent($id): object
    {
        return Student::where("id", $id)->first();
    }

    public function updateStudent($data, $id): void
    {
        $data = [
            "name" => $data->name,
            "phone" => $data->phone,
            "email" => $data->email,
            "address" => $data->address,
            "major_id" => $data->majorId,
        ];

        Student::where("id", $id)->update($data);
    }

    public function destoryStudent($id): void
    {
        Student::findOrFail($id)->delete();
    }
}
