<?php

namespace App\Http\Controllers;

use App\Contracts\Services\StudentServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentCreateRequest;
use App\Http\Requests\StudentUpdateRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class StudentController extends Controller
{
    private $studentDao;
    public function __construct(StudentServiceInterface $studentServiceInterface)
    {
        $this->studentDao = $studentServiceInterface;
    }

    // index
    public function index(): View
    {
        $students = $this->studentDao->getStudent();

        return view("students.index")->with(["students" => $students]);
    }

    // create
    public function create(): View
    {
        $majors = $this->studentDao->getMajor();

        return view("students.create")->with(["majors" => $majors]);
    }

    // store
    public function store(StudentCreateRequest $request): RedirectResponse
    {
        $this->studentDao->storeStudent($request);

        return to_route('student.index')->with(['success' => "Create Successfully"]);
    }

    // edit
    public function edit($id): View
    {
        $student = $this->studentDao->editStudent($id);
        $majors = $this->studentDao->getMajor();

        return view("students.edit")->with(["student" => $student, "majors" => $majors]);
    }

    // update
    public function update(StudentUpdateRequest $request, $id): RedirectResponse
    {
        $this->studentDao->updateStudent($request, $id);

        return to_route("student.index")->with(["success" => "Update Successfully"]);
    }

    // destroy
    public function destroy($id): RedirectResponse
    {
        $this->studentDao->destoryStudent($id);

        return to_route('student.index')->with(['delete' => "Delete Successfully"]);
    }
}
