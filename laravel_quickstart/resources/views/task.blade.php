@extends('layouts.app')

@section('content')

    @if (session("create"))
        <div class="w-25 mx-auto my-3">
            <div class="alert alert-success">
                Create successfully !
            </div>
        </div>
    @endif
    <div class="card w-25 mx-auto p-5 mb-5">
        <form action="{{ route('task#create') }}" method="POST" class="form-horizontal">
            @csrf

            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Task</label>

                <div class="col-sm-6 my-3 w-100">
                    <input type="text" name="name" id="task-name" class="form-control w-100">
                    @error('name')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Add Task
                    </button>
                </div>
            </div>
        </form>
    </div>

    @if (session("delete"))
        <div class="w-25 mx-auto my-3">
            <div class="alert alert-danger">
                Delete successfully !
            </div>
        </div>
    @endif
    <div class="card w-25 mx-auto">
        <div class="card-header">
            Current Tasks
        </div>
        <table class="table table-striped">
            <tr>
                <th>Task</th>
                <th></th>
            </tr>
            @foreach ($getTask as $task)
                <tr>
                    <td>{{ $task->name }}</td>
                    <td>
                        <form action="{{route('task#delete',['id'=>$task->id])}}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection

