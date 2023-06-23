<?php

namespace App\Http\Controllers;

use App\Contracts\Services\MajorServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\MajorCreateRequest;
use App\Http\Requests\MajorUpdateRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    private $majorService;

    public function __construct(MajorServiceInterface $majorServiceInterface)
    {
        $this->majorService = $majorServiceInterface;
    }

    // index
    public function index(): View
    {
        $majors = $this->majorService->getMajor();

        return view("majors.index")->with(["majors" => $majors]);
    }

    // create
    public function create(): View
    {
        return view("majors.create");
    }

    // store
    public function store(MajorCreateRequest $request): RedirectResponse
    {
        $this->majorService->storeMajor($request);

        return to_route('major.index')->with(['success' => "Create Successfully"]);
    }

    // edit
    public function edit($id): View
    {
        $major = $this->majorService->editMajor($id);

        return view("majors.edit", compact("major"));
    }

    // update
    public function update(MajorUpdateRequest $request, $id): RedirectResponse
    {
        $this->majorService->updateMajor($request, $id);

        return to_route("major.index")->with(["success" => "Update Successfully"]);
    }

    // destroy
    public function destroy($id): RedirectResponse
    {
        $this->majorService->destoryMajor($id);

        return to_route('major.index')->with(['delete' => "Delete Successfully"]);
    }
}
