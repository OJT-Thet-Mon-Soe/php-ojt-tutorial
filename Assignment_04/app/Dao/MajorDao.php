<?php

namespace App\Dao;

use App\Models\Major;
use App\Contracts\Dao\MajorDaoInterface;

class MajorDao implements MajorDaoInterface
{
    public function getMajor(): object
    {
        return Major::get();
    }
    public function storeMajor($request)
    {
        Major::create([
            "name" => $request->name,
        ]);

        return Major::latest()->first();
    }

    public function destoryMajor($id): void
    {
        Major::findOrFail($id)->delete();
    }

    public function editMajor($id): object
    {
        return Major::where("id", $id)->first();
    }

    public function updateMajor($data, $id): void
    {
        Major::where("id", $id)->update([
            "name" => $data->name,
        ]);
    }
}
