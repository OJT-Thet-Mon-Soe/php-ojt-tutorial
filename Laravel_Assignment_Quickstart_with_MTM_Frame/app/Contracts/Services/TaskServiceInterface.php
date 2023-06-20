<?php

namespace App\Contracts\Services;

interface TaskServiceInterface
{
    public function getServiceTask(): object;

    public function createTaskService($data);

    public function deleteTaskService($id): void;

}
