@extends('layouts.app')
@section('content')
    <div class="container pt-5">
        <div class="card">
            <div class="card-header fs-5 fw-bold">
                Major Edit
            </div>
            <div class="card-body">
                <form action="{{ route('major.update', ['id' => $major->id]) }}" method="POST">
                    @csrf
                    @method('patch')
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter major name"
                        value="{{ old('name', $major->name) }}">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="d-flex justify-content-between my-3">
                        <a href="{{ route('major.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
