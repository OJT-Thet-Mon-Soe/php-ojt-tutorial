<?php

namespace App\Dao;

use App\Models\Major;
use App\Models\Student;
use App\Contracts\Dao\StudentDaoInterface;

class StudentDao implements StudentDaoInterface
{
    public function getStudent(): object
    {
        return Student::with("major")->get();
    }

    public function getMajor()
    {
        return Major::get();
    }

    public function storeStudent($request)
    {
        $data = [
            "name" => $request->name,
            "phone" => $request->phone,
            "email" => $request->email,
            "address" => $request->address,
            "major_id" => $request->majorId,
        ];
        Student::create($data);

        return Student::with('major')->latest()->first();
    }

    public function destoryStudent($id): void
    {
        Student::findOrFail($id)->delete();
    }

    public function editStudent($id): object
    {
        return Student::where("id", $id)->first();
    }

    public function updateStudent($data, $id)
    {
        $data = [
            "name" => $data->name,
            "phone" => $data->phone,
            "email" => $data->email,
            "address" => $data->address,
            "major_id" => $data->majorId,
        ];

        Student::where("id", $id)->update($data);

        return Student::with("major")->where("id",$id)->first();

    }
}
