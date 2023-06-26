@extends('layouts.app')
@section('content')
    <div class="container pt-5">
        @if (session('success'))
            <div class="alert alert-success w-25">{{ session('success') }}</div>
        @endif
        @if (session('delete'))
            <div class="alert alert-danger w-25">{{ session('delete') }}</div>
        @endif
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('student.create') }}" class="btn btn-primary my-3">Create</a>
            </div>
            <div>
                <a href="{{ route('student.export') }}" class="btn btn-primary">Export</a>
                <!-- Button trigger modal -->
                <a href="{{ route('student.import') }}" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#staticBackdrop">
                    Import
                </a>
            </div>
        </div>
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
                                        class="d-inline" id="deleteForm">
                                        @csrf
                                        @method('delete')
                                        <button type="button" onclick="confirmDelete()"
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

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('student.import') }}" method="post">
                        @csrf
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Choose Excel File</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="file" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
