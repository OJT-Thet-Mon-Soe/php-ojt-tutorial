<?php

namespace App\Contracts\Services;

interface MajorServiceInterface
{
    public function getMajor(): object;

    public function storeMajor($request);

    public function destoryMajor($id): void;

    public function editMajor($id): object;

    public function updateMajor($data, $id): void;

}
