<?php

namespace App\Dao;
use App\Models\Task;
use App\Contracts\Dao\TaskDaoInterface;
use Illuminate\Support\Facades\Validator;

class TaskDao implements TaskDaoInterface{
    public function getDaoTask():object
    {
        return Task::get();
    }

    public function createTaskDao($request)
    {
        $data = [
            "name" => $request->name,
        ];

        Task::create($data);
    }

    public function deleteTaskDao($id): void
    {
        Task::findOrfail($id)->delete();
    }

}
