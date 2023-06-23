<?php

namespace App\Contracts\Dao;

interface StudentDaoInterface
{
    public function getStudent(): object;
    public function getMajor();
    public function storeStudent($request): void;
    public function editStudent($id): object;
    public function updateStudent($data, $id): void;
    public function exportExcel();
    public function importExcel($request);
    public function destoryStudent($id): void;
}
