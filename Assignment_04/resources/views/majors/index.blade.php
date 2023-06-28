@extends('layouts.app')
@section('content')
    <div class="container pt-5">
        <div class="alert alert-danger w-25 d-none" id="deleteSuccess">Delete Successfully !</div>
        <!-- Button trigger modal -->
        <button type="button" id="originCreateButton" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Create
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Major Create</h1>
                        <button type="button" class="btn-close" onclick="closeBtn()" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success d-none" id="success">Create Successfully !</div>
                        <form>
                            <label class="form-label">Name</label>
                            <input type="text" id="name" class="form-control" placeholder="Enter major name">
                            <p class="text-danger" id="errMsg"></p>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeBtn()"
                            data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="createBtn">Create</button>

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

                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Major Edit</h1>
                        <button type="button" class="btn-close" onclick="closeEditBtn()" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success d-none" id="successUpdate">Update Successfully !</div>
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
    <script src="{{asset('js/major.js')}}"></script>
@endsection
