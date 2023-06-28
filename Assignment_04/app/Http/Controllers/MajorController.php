<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Http\Requests\MajorCreateRequest;
use App\Http\Requests\MajorUpdateRequest;
use App\Contracts\Services\MajorServiceInterface;

class MajorController extends Controller
{
    private $majorService;

    public function __construct(MajorServiceInterface $majorServiceInterface)
    {
        $this->majorService = $majorServiceInterface;
    }

    // index
    public function index()
    {
        $majors = $this->majorService->getMajor();

        return view("majors.index", compact("majors"));

    }

    // show
    public function show()
    {
        $majors = $this->majorService->getMajor();

        return response()->json($majors);
    }

    // create
    public function create(): View
    {
        return view("majors.create");
    }

    // store
    public function store(MajorCreateRequest $request)
    {
        $majors = $this->majorService->storeMajor($request);

        return response()->json($majors);
    }

    // edit
    public function edit($id)
    {
        $major = $this->majorService->editMajor($id);

        return response()->json($major);

    }

    // update
    public function update(MajorUpdateRequest $request, $id)
    {
        $this->majorService->updateMajor($request, $id);
        $major = $this->majorService->editMajor($id);

        return response()->json($major);
    }

    // destroy
    public function destroy($id)
    {
        $this->majorService->destoryMajor($id);

        return response()->json("delete");
    }
}
