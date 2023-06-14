<?php

namespace App\Http\Controllers;

use App\Http\Requests\Punishments\AddPunishmentRequest;
use App\Http\Requests\Punishments\PunishmentsReportRequest;
use App\Http\Requests\Punishments\UpdatePunishmentRequest;
use App\Http\Resources\Punishments\PunishmentResource;
use App\Models\Punishment;
use App\Models\Staff;
use Illuminate\Http\Request;

class PunishmentsController extends Controller
{
    public function AddPunishment(AddPunishmentRequest $request)
    {
        $punishment = new Punishment();

        $punishment->staff_id = $request->staff_id;
        $punishment->amount = $request->amount;
        $punishment->reason = $request->reason;
        $punishment->date = $request->date;

        $punishment->save();

        return response()->json([
            'message'=>"تم إضافة مكافئة للموظف بنجاح",
            'punishment'=>new PunishmentResource($punishment),
        ]);
    }

    public function UpdatePunishment(UpdatePunishmentRequest $request,$id)
    {
        $punishment = Punishment::find($id);

        $punishment->amount = $request->amount;
        $punishment->reason = $request->reason;
        $punishment->date = $request->date;

        $punishment->save();

        return response()->json([
            'message'=>"تم تعديل مكافئة الموظف بنجاح",
            'punishment'=>new PunishmentResource($punishment),
        ]);
    }

    public function GetPunishmentsForStaff($id)
    {
        $punishments = Punishment::where('staff_id',$id)->get();

        return PunishmentResource::collection($punishments);
    }

    public function GetAllPunishments()
    {
        $punishments = Punishment::all();

        return PunishmentResource::collection($punishments);
    }

    public function GetPunishment($id)
    {
        $punishment = Punishment::find($id);

        return new PunishmentResource($punishment);
    }

    public function PunishmentsReport(PunishmentsReportRequest $request)
    {
        $punishments = Punishment::whereBetween('date',[$request->from_date,$request->to_date]);

        if($request->first_name)
        {
            $staff = Staff::where('first_name',$request->first_name)->get();

            $ids = [];
            foreach($staff as $member)
            {
                array_push($ids,$member->id);
            }

            $punishments = $punishments->whereIn('staff_id',$ids);
        }

        if($request->father_name)
        {
            $staff = Staff::where('father_name',$request->father_name)->get();

            $ids = [];
            foreach($staff as $member)
            {
                array_push($ids,$member->id);
            }

            $punishments = $punishments->whereIn('staff_id',$ids);
        }

        if($request->last_name)
        {
            $staff = Staff::where('last_name',$request->last_name)->get();

            $ids = [];
            foreach($staff as $member)
            {
                array_push($ids,$member->id);
            }

            $punishments = $punishments->whereIn('staff_id',$ids);
        }

        $punishments = $punishments->get();

        return PunishmentResource::collection($punishments);
    }
}
