@extends('layouts.app')
@section('content')
    <div class="container pt-5">
        @if (session('success'))
            <div class="alert alert-success w-25">{{ session('success') }}</div>
        @endif
        @if (session('delete'))
            <div class="alert alert-danger w-25">{{ session('delete') }}</div>
        @endif
        <a href="{{ route('major.create') }}" class="btn btn-primary my-3">Create</a>
        <div class="card">
            <div class="card-header fs-5 fw-bold">
                Major Lists
            </div>
            @if ($majors->isEmpty() == false)
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Id</th>
                            <th>Major</th>
                            <th>Actions</th>
                        </tr>
                        @foreach ($majors as $major)
                            <tr>
                                <td>{{ $major->id }}</td>
                                <td>{{ $major->name }}</td>
                                <td>
                                    <a href="{{ route('major.edit', ['id' => $major->id]) }}"
                                        class="btn btn-success">Edit</a>
                                    <form action="{{ route('major.destroy', ['id' => $major->id]) }}" method="post"
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
    </div>
@endsection
