@extends('layouts.app')
@section('content')
    <div class="container pt-5">
        <div class="card">
            <div class="card-header fs-5 fw-bold">
                Major Create
            </div>
            <div class="card-body">
                <form action="{{ route('major.store') }}" method="POST">
                    @csrf
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter major name">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="d-flex justify-content-between my-3">
                        <a href="{{ route('major.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
