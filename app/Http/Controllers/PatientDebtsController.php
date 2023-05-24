<?php

namespace App\Http\Controllers;

use App\Http\Resources\Patients\MainPatientDebtResource;
use App\Http\Resources\Patients\PatientResource;
use App\Models\Patient;
use App\Models\PatientDebt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientDebtsController extends Controller
{
    private static function Find($id,$array)
    {
        foreach($array as $value)
        {
            if($id == $value)
            {
                return true;
            }
        }
        return false;
    }

    public function AddPatientDebt(Request $request)
    {
        $new = new PatientDebt();

        $new->patient_id = $request->patient_id;
        $new->amount = $request->amount;
        $new->date = $request->date;

        $new->save();

        return response()->json([
            'message'=>"تم إضافة دين للمريض",
            'debt'=>new MainPatientDebtResource($new)
        ]);
    }

    public function UpdatePatientDebt(Request $request, $id)
    {
        $debt = PatientDebt::find($id);

        $debt->patient_id = $request->patient_id;
        $debt->amount = $request->amount;
        $debt->date = $request->date;

        $debt->save();

        return response()->json([
            'message'=>"تم تعديل دين للمريض",
            'debt'=>new MainPatientDebtResource($debt)
        ]);
    }

    public function PayDebts(Request $request)
    {
        PatientDebt::whereIn('id',$request->patient_debts)->update(['is_paid'=>true]);

        $tests = PatientDebt::whereIn('id',$request->patient_debts)->get();

        return MainPatientDebtResource::collection($tests);
    }

    public function GetPatientDebts($id)
    {
        $debts = PatientDebt::where('patient_id',$id)->get();

        return MainPatientDebtResource::collection($debts);
    }

    public function GetUnpaidPatientDebts($id)
    {
        $debts = PatientDebt::where('patient_id',$id)->where('is_paid',false)->get();

        return MainPatientDebtResource::collection($debts);
    }

    public function GetAllDebts()
    {
        $debts = PatientDebt::all();

        return MainPatientDebtResource::collection($debts);
    }

    public function GetDebt($id)
    {
        $debt = PatientDebt::find($id);

        return new MainPatientDebtResource($debt);
    }

    public function GetIndebtedPatients()
    {
        $debts = PatientDebt::where('is_paid',false)->get();
        $patients_id = [];

        foreach($debts as $debt)
        {
            if(PatientDebtsController::Find($debt->patient_id,$patients_id))
            {
                array_push($patients_id,$debt->patient_id);
            }
        }

        $patients = Patient::whereIn('id',$patients_id)->get();

        return PatientResource::collection($patients);
    }
}
