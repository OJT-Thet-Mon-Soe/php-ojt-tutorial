@extends('layouts.app')
@section('content')
    <div class="container pt-5">
        <div class="alert alert-success w-25 d-none" id="successStore">Create Successfully !</div>
        <div class="alert alert-success w-25 d-none" id="successUpdate">Update Successfully !</div>
        <div class="alert alert-danger w-25 d-none" id="deleteSuccess">Delete Successfully !</div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createModal">
            Create
        </button>
        <!-- Modal -->
        <div class="">
            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createModalLabel">Student Create</h1>
                            <button type="button" class="btn-close" onclick="createBtnClose()" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="myForm">
                                @csrf
                                <label class="form-label mt-2">Name</label>
                                <input type="text" id="name" class="form-control mt-2"
                                    placeholder="Enter your name">
                                <p class="text-danger error" id="errName"></p>

                                <label class="form-label mt-2">Major</label>
                                <select class="form-select mt-2" aria-label="Default select example" id="majorId">
                                    <option value="">Choose major ...</option>
                                </select>
                                <p class="text-danger error" id="errMajorId"></p>

                                <label class="form-label mt-2">Phone</label>
                                <input type="text" id="phone" class="form-control mt-2" placeholder="09xxxxxxxxx">
                                <p class="text-danger error" id="errPhone"></p>

                                <label class="form-label mt-2">Email</label>
                                <input type="email" id="email" class="form-control mt-2"
                                    placeholder="Enter email address">
                                <p class="text-danger error" id="errEmail"></p>

                                <label class="form-label mt-2">Address</label>
                                <input type="text" id="address" class="form-control mt-2" placeholder="Enter address">
                                <p class="text-danger error" id="errAddress"></p>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" onclick="createBtnClose()"
                                data-bs-dismiss="modal">Close</button>
                            <button type="button" onclick="createStudentBtn()" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header fs-5 fw-bold">
                Student Lists
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Major</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableData">
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td id="updateName-{{ $student->id }}">{{ $student->name }}</td>
                                <td id="updateMajorName-{{ $student->id }}">{{ $student->major->name }}</td>
                                <td id="updatePhone-{{ $student->id }}">{{ $student->phone }}</td>
                                <td id="updateEmail-{{ $student->id }}">{{ $student->email }}</td>
                                <td id="updateAddress-{{ $student->id }}">
                                    @if (strlen($student->address) > 50)
                                        {{ substr($student->address, 0, 50) . '...' }}
                                    @else
                                        {{ $student->address }}
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary"
                                        onclick="editStudent({{ $student->id }})" data-bs-toggle="modal"
                                        data-bs-target="#editModal" id="edit-{{ $student->id }}">
                                        Edit
                                    </button>
                                    <button type="button" id="deleting-{{ $student->id }}"
                                        onclick="confirmDelete({{ $student->id }})" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Student Edit</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="btnCloseStudentUpdate()"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="myForm">
                        @csrf

                        <input type="hidden" id="editId" class="form-control mt-2">

                        <label class="form-label mt-2">Name</label>
                        <input type="text" id="editName" class="form-control mt-2" placeholder="Enter your name">
                        <p class="text-danger" id="errUpdateName"></p>

                        <label class="form-label mt-2">Major</label>
                        <select class="form-select mt-2" aria-label="Default select example" id="editMajorId">
                            <option value="">Choose major ...</option>
                        </select>
                        <p class="text-danger" id="errUpdateMajorId"></p>

                        <label class="form-label mt-2">Phone</label>
                        <input type="text" id="editPhone" class="form-control mt-2" placeholder="09xxxxxxxxx"
                            value="{{ old('phone') }}">
                        <p class="text-danger" id="errUpdatePhone"></p>

                        <label class="form-label mt-2">Email</label>
                        <input type="email" id="editEmail" class="form-control mt-2" placeholder="Enter email address"
                            value="{{ old('email') }}">
                        <p class="text-danger" id="errUpdateEmail"></p>

                        <label class="form-label mt-2">Address</label>
                        <input type="text" id="editAddress" class="form-control mt-2" placeholder="Enter address"
                            value="{{ old('address') }}">
                        <p class="text-danger" id="errUpdateAddress"></p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="btnCloseStudentUpdate()"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" onclick="updateStudentBtn()" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/student.js') }}"></script>
@endsection
