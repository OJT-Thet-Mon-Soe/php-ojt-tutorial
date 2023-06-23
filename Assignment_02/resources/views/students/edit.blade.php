@extends('layouts.app')
@section('content')
    <div class="container pt-5">
        <div class="card">
            <div class="card-header fs-5 fw-bold">
                Student Edit
            </div>
            <div class="card-body">
                <form action="{{ route('student.update', ['id' => $student->id]) }}" method="POST">
                    @csrf
                    <label class="form-label mt-2">Name</label>
                    <input type="text" name="name" class="form-control mt-2" placeholder="Enter your name"
                        value="{{ old('name', $student->name) }}">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <label class="form-label mt-2">Major</label>
                    <select class="form-select mt-2" aria-label="Default select example" name="majorId">
                        <option value="">Choose major ...</option>
                        @foreach ($majors as $major)
                            <option value="{{ $major->id }}">{{ $major->name }}</option>
                        @endforeach
                    </select>
                    @error('majorId')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <label class="form-label mt-2">Phone</label>
                    <input type="text" name="phone" class="form-control mt-2" placeholder="Enter phone number"
                        value="{{ old('phone', $student->phone) }}">
                    @error('phone')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <label class="form-label mt-2">Email</label>
                    <input type="email" name="email" class="form-control mt-2" placeholder="Enter email address"
                        value="{{ old('email', $student->email) }}">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <label class="form-label mt-2">Address</label>
                    <input type="text" name="address" class="form-control mt-2" placeholder="Enter address"
                        value="{{ old('address', $student->address) }}">
                    @error('address')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    <div class="d-flex justify-content-between my-3">
                        <a href="{{ route('student.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
