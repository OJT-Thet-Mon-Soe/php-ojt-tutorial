<?php

namespace App\Contracts\Dao;

interface MajorDaoInterface
{
    public function getMajor(): object;

    public function storeMajor($request): void;

    public function destoryMajor($id): void;

    public function editMajor($id): object;
    
    public function updateMajor($data, $id): void;
}
