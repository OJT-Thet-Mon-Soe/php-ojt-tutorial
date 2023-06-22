<?php

namespace App\Services;

use App\Contracts\Dao\StudentDaoInterface;
use App\Contracts\Services\StudentServiceInterface;

class StudentService implements StudentServiceInterface
{
    private $studentDao;
    public function __construct(StudentDaoInterface $studentDaoInterface)
    {
        $this->studentDao = $studentDaoInterface;
    }

    public function getStudent(): object
    {
        return $this->studentDao->getStudent();
    }

    public function getMajor()
    {
        return $this->studentDao->getMajor();
    }

    public function storeStudent($request): void
    {
        $this->studentDao->storeStudent($request);
    }

    public function destoryStudent($id): void
    {
        $this->studentDao->destoryStudent($id);
    }

    public function editStudent($id): object
    {
        return $this->studentDao->editStudent($id);
    }

    public function updateStudent($data, $id): void
    {
        $this->studentDao->updateStudent($data, $id);
    }
}
