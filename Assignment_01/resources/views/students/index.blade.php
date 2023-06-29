@extends('layouts.app')
@section('content')
    <div class="container pt-5">
        @if (session('success'))
            <div class="alert alert-success w-25">{{ session('success') }}</div>
        @endif
        @if (session('delete'))
            <div class="alert alert-danger w-25">{{ session('delete') }}</div>
        @endif
        <a href="{{ route('student.create') }}" class="btn btn-primary my-3">Create</a>
        <div class="card">
            <div class="card-header fs-5 fw-bold">
                Student Lists
            </div>
            @if ($students->isEmpty() == false)
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Major</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>

                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->major->name }}</td>
                                <td>{{ $student->phone }}</td>
                                <td>{{ $student->email }}</td>
                                <td>
                                    @if (strlen($student->address) > 50)
                                        {{ substr($student->address, 0, 50) . '...' }}
                                    @else
                                        {{ $student->address }}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('student.edit', ['id' => $student->id]) }}"
                                        class="btn btn-success">Edit</a>
                                    <form action="{{ route('student.destroy', ['id' => $student->id]) }}" method="post"
                                        class="d-inline" id="deleteForm-{{$student->id}}">
                                        @csrf
                                        @method('delete')
                                        <button type="button" onclick="confirmDelete({{ $student->id }})"
                                            class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @else
                <h3 class="text-center my-5">There is no data.</h3>
            @endif
        </div>
    </div>
@endsection
