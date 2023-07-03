<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentCreateRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Contracts\Services\StudentServiceInterface;

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

        return view("students.index", compact("students"));
    }

    // major
    public function major()
    {
        $majors = $this->studentDao->getMajor();

        return response()->json($majors);
    }

    // store
    public function store(StudentCreateRequest $request)
    {
        $student = $this->studentDao->storeStudent($request);

        return response()->json($student);
    }

    // edit
    public function edit($id)
    {
        $student = $this->studentDao->editStudent($id);
        $majors = $this->studentDao->getMajor();

        return response()->json(["student" => $student, "majors" => $majors]);
    }

    // update
    public function update(StudentUpdateRequest $request, $id)
    {
        $student = $this->studentDao->updateStudent($request, $id);

        return response()->json($student);
    }

    // destroy
    public function destroy($id)
    {
        $this->studentDao->destoryStudent($id);

        return response()->json("delete");
    }
}
