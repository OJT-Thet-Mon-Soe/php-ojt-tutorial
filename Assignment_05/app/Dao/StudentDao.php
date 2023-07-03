<?php

namespace App\Dao;

use App\Models\Major;
use App\Models\Student;
use App\Exports\StudentExport;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Contracts\Dao\StudentDaoInterface;
use App\Mail\StudentMail;
use Illuminate\Support\Facades\Mail;

class StudentDao implements StudentDaoInterface
{
    public function getStudent($request): object
    {
        $searchKey = $request->searchKey;

        return Student::select("students.*", "majors.name as major_name")
            ->join("majors", "students.major_id", "=", "majors.id")
            ->when($searchKey, function ($query) use ($searchKey) {
                $query->where('students.name', 'like', '%' . $searchKey . '%')
                    ->orWhere('majors.name', 'like', '%' . $searchKey . '%')
                    ->orWhere('students.phone', 'like', '%' . $searchKey . '%')
                    ->orWhere('students.email', 'like', '%' . $searchKey . '%')
                    ->orWhere('students.address', 'like', '%' . $searchKey . '%');
            })
            ->get();
    }

    public function getMajor()
    {
        return Major::get();
    }

    public function storeStudent($request): object
    {
        $data = [
            "name" => $request->name,
            "phone" => $request->phone,
            "email" => $request->email,
            "address" => $request->address,
            "major_id" => $request->majorId,
        ];
        $student = Student::create($data);

        return $student;
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

    public function exportExcel()
    {
        return Excel::download(new StudentExport(), 'student.xlsx');
    }

    public function importExcel($request)
    {
        $file = $request->file('excelFile');

        return Excel::import(new StudentImport, $file);
    }

    public function destoryStudent($id): void
    {
        Student::findOrFail($id)->delete();
    }
}
