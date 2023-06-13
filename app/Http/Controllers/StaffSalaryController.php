<?php

namespace App\Http\Controllers;

use App\Http\Resources\StaffResource;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffSalaryController extends Controller
{
    public function UpdateStaffSalary(Request $request,$id)
    {
        $staff = Staff::find($id);

        $staff->salary = $request->salary;

        $staff->save();

        return response()->json([
            'message'=>"تم تعديل راتب الموظف",
            'staff'=>new StaffResource($staff)
        ]);
    }

    public function GetStaff()
    {
        $staff = Staff::all();

        return StaffResource::collection($staff);
    }

    public function GetStaffMember($id)
    {
        $staff = Staff::find($id);

        return new StaffResource($staff);
    }
}
