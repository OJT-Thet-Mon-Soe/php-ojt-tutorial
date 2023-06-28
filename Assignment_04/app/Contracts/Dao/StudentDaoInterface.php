<?php

namespace App\Contracts\Dao;

interface StudentDaoInterface
{
    public function getStudent(): object;

    public function getMajor();

    public function storeStudent($request);

    public function destoryStudent($id): void;

    public function editStudent($id): object;

    public function updateStudent($data, $id);
}
