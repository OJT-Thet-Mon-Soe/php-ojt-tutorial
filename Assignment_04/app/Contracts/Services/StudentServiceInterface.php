<?php

namespace App\Contracts\Services;

interface StudentServiceInterface
{
    public function getStudent(): object;

    public function getMajor();

    public function storeStudent($request);

    public function destoryStudent($id): void;

    public function editStudent($id): object;

    public function updateStudent($data, $id);

}
