@extends('layouts.app')
@section('content')
    <div class="container pt-5">
        <!-- Button trigger modal -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <button type="button" id="originCreateButton" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#createModal">
                Create
            </button>
            <div class="alert alert-success d-none" id="success">Create Successfully !</div>
            <div class="alert alert-danger w-25 d-none" id="deleteSuccess">Delete Successfully !</div>
            <div class="alert alert-success d-none" id="successUpdate">Update Successfully !</div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="createModalLabel">Major Create</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <label class="form-label">Name</label>
                            <input type="text" id="name" class="form-control" placeholder="Enter major name">
                            <p class="text-danger" id="errMsg"></p>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="createBtn" onclick="createBtn()">Create</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header fs-5 fw-bold">
                Major Lists
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Major</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableData">
                        @foreach ($majors as $major)
                            <tr>
                                <td>{{ $major->id }}</td>
                                <td id="updateId-{{ $major->id }}">{{ $major->name }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" id="edit-{{ $major->id }}" onclick="editMajor({{ $major->id }})"
                                        data-bs-toggle="modal" data-bs-target="#editModal">
                                        Edit
                                    </button>
                                    <button type="button" id="deleting-{{ $major->id }}"
                                        onclick="confirmDelete({{ $major->id }})" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel">Major Edit</h1>
                        <button type="button" class="btn-close" onclick="closeEditBtn()" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <input type="hidden" id="editId">
                            <label class="form-label">Name</label>
                            <input type="text" id="editName" class="form-control" placeholder="Enter major name">
                            <p class="text-danger" id="errMsgUpdate"></p>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeEditBtn()"
                            data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="updateMajorBtn()"
                            id="createBtn">Update</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/major.js') }}"></script>
@endsection
