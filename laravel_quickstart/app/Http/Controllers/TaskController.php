<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    function task(){
        $getTask = Task::get();
        return view('task')->with(['getTask'=>$getTask]);
    }

    function create(Request $request){
        $data = [
            "name" => $request->name,
        ];
        Validator::make($request->all(),[
            'name' => 'required'
        ])->validate();
        Task::create($data);
        return redirect()->route('task')->with(['create'=>"create"]);
    }

    function delete(Request $request){
        $id = $request->id;
        Task::where("id",$id)->delete();
        return redirect()->route('task')->with(['delete'=>"delete"]);
    }
}
