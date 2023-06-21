<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TaskStoreRequest;
use App\Contracts\Services\TaskServiceInterface;

class TaskController extends Controller
{
    // Interface
    private $taskService;
    public function __construct(TaskServiceInterface $taskServiceInterface){
        $this->taskService = $taskServiceInterface;
    }

    public function index(){
        $tasks = $this->taskService->getServiceTask();

        return view('task')->with(['tasks'=>$tasks]);
    }

    public function store(TaskStoreRequest $request){

        $this->taskService->createTaskService($request);

        return to_route('task.index')->with(['success'=>"Create Successfully"]);

    }

    public function destroy($id){
        $this->taskService->deleteTaskService($id);

        return to_route('task.index')->with(['delete'=>"Delete Successfully"]);
    }
}
