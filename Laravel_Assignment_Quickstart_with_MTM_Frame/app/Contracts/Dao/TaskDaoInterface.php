<?php

namespace App\Contracts\Dao;

interface TaskDaoInterface
{
    public function getDaoTask(): object;

    public function createTaskDao($data);

    public function deleteTaskDao($id): void;

}

