<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::get();

        return view('task')->with(['tasks'=>$tasks]);
    }

    public function store(Request $request)
    {
        $data = [
            "name" => $request->name,
        ];
        Validator::make($request->all(),[
            'name' => 'required'
        ])->validate();
        Task::create($data);

        return to_route("task.index")->with(['success'=>"Create Successfully"]);
    }

    public function destroy($id)
    {
        Task::findOrFail($id)->delete();

        return to_route('task.index')->with(['delete'=>"Delete Successfully"]);
    }
}
