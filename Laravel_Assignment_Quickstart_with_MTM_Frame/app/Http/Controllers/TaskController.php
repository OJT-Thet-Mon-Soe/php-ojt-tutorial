<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\Services\TaskServiceInterface;

class TaskController extends Controller
{
    // Interface
    private $taskService;
    function __construct(TaskServiceInterface $taskServiceInterface){
        $this->taskService = $taskServiceInterface;
    }

    function task(){
        $getTask = $this->taskService->getServiceTask();
        return view('task')->with(['getTask'=>$getTask]);
    }

    function create(Request $request){
        $data = [
            "name" => $request->name,
        ];

        if($this->taskService->createTaskService($data)){
            $validator = $this->taskService->createTaskService($data);
            if($validator->fails()){
                return back()
                    ->withInput()
                    ->withErrors($validator);
                }
        }
        return redirect()->route('task')->with(['create'=>"create"]);

    }

    function delete(Request $request){
        $id = $request->id;
        $this->taskService->deleteTaskService($id);
        return redirect()->route('task')->with(['delete'=>"delete"]);
    }
}
