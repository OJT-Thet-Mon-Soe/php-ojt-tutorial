<?php

namespace App\Services;

use App\Mail\StudentMail;
use Illuminate\Support\Facades\Mail;
use App\Contracts\Dao\StudentDaoInterface;
use App\Contracts\Services\StudentServiceInterface;

class StudentService implements StudentServiceInterface
{
    private $studentDao;
    public function __construct(StudentDaoInterface $studentDaoInterface)
    {
        $this->studentDao = $studentDaoInterface;
    }

    public function getStudent($request): object
    {
        return $this->studentDao->getStudent($request);
    }

    public function getMajor()
    {
        return $this->studentDao->getMajor();
    }

    public function storeStudent($request): void
    {
        $student = $this->studentDao->storeStudent($request);

        $majorName = $student->major->name;
        $mailData = [
            "id" => $student->id,
            "name" => $student->name,
            "phone" => $student->phone,
            "email" => $student->email,
            "address" => $student->address,
            "majorName" => $majorName,
        ];

        Mail::to($request->email)->send(new StudentMail($mailData));
    }

    public function destoryStudent($id): void
    {
        $this->studentDao->destoryStudent($id);
    }

    public function editStudent($id): object
    {
        return $this->studentDao->editStudent($id);
    }

    public function exportExcel()
    {
        return $this->studentDao->exportExcel();
    }

    public function importExcel($request)
    {
        return $this->studentDao->importExcel($request);
    }

    public function updateStudent($data, $id): void
    {
        $this->studentDao->updateStudent($data, $id);
    }
}
