<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StudentCreateRequest;
use App\Http\Requests\StudentImportRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Contracts\Services\StudentServiceInterface;
use App\Models\Student;
use Maatwebsite\Excel\Validators\ValidationException;

class StudentController extends Controller
{
    private $studentDao;

    public function __construct(StudentServiceInterface $studentServiceInterface)
    {
        $this->studentDao = $studentServiceInterface;
    }

    // index
    public function index(Request $request): View
    {
        $students = $this->studentDao->getStudent($request);

        return view("students.index", compact("students"));
    }

    // create
    public function create(): View
    {
        $majors = $this->studentDao->getMajor();

        return view("students.create", compact("majors"));
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

        return view("students.edit", compact("student", "majors"));
    }

    // update
    public function update(StudentUpdateRequest $request, $id): RedirectResponse
    {
        $this->studentDao->updateStudent($request, $id);

        return to_route("student.index")->with(["success" => "Update Successfully"]);
    }

    // export
    public function export()
    {
        return $this->studentDao->exportExcel();

        return to_route("student.index");
    }

    // import
    public function import(): View
    {
        return view("students.import");
    }

    // store for import
    public function importStore(StudentImportRequest $request): RedirectResponse
    {
        try {
            $this->studentDao->importExcel($request);
        } catch (ValidationException $e) {
            $failures = $e->failures();

            return to_route('student.import')->with(["excelError" => $failures]);
        }

        return to_route('student.index')->with(["success" => "Import Successfully !"]);
    }

    // destroy
    public function destroy($id): RedirectResponse
    {
        $this->studentDao->destoryStudent($id);

        return to_route('student.index')->with(['delete' => "Delete Successfully"]);
    }
}
