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

    public function createTaskDao($data)
    {
        $validator = Validator::make($data,[
            'name' => 'required'
        ]);
        return $validator;
        
        Task::create($data);
    }

    public function deleteTaskDao($id): void
    {
        Task::where("id",$id)->delete();
    }

}
