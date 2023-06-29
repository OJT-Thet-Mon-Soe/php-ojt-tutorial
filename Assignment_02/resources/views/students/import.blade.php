@extends('layouts.app')
@section('content')
    <div class="container pt-5">
        @if (session('excelError'))
            @foreach (session('excelError') as $failure)
                <div class="alert alert-danger mb-3">
                    Email is already been taken in line No {{ $failure->row()-1 }} !
                </div>
            @endforeach
        @endif
        <div class="card">
            <div class="card-header fs-5 fw-bold">
                Choose excel file
            </div>
            <div class="card-body">
                <form action="{{ route('student.import.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="excelFile" class="form-control">
                    @error('excelFile')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mt-3">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
