<?php

namespace App\Services;
use App\Contracts\Services\TaskServiceInterface;
use App\Contracts\Dao\TaskDaoInterface;

class TaskService implements TaskServiceInterface{

    private $taskDao;

    public function __construct(TaskDaoInterface $taskDaoInterface){
        $this->taskDao = $taskDaoInterface;
    }

    public function getServiceTask(): object
    {
        return $this->taskDao->getDaoTask();
    }

    public function createTaskService($data)
    {
        return $this->taskDao->createTaskDao($data);
    }

    public function deleteTaskService($id): void
    {
        $this->taskDao->deleteTaskDao($id);
    }

}
