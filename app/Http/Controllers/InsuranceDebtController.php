<?php

namespace App\Http\Controllers;

use App\Http\Resources\Insurance\InsuranceResource;
use App\Http\Resources\Insurance\MainInsuranceDebtResource;
use App\Models\Insurance;
use App\Models\InsuranceDebt;
use Illuminate\Http\Request;

class InsuranceDebtController extends Controller
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

    public function AddInsuranceDebt(Request $request)
    {
        $debt = new InsuranceDebt();

        $debt->insurance_id = $request->insurance_id;
        $debt->amount = $request->amount;
        $debt->date = $request->date;

        $debt->save();

        return response()->json([
            'message'=>'تم إضافة الجين إلى التأمين',
            'debt'=>new MainInsuranceDebtResource($debt),
        ]);
    }

    public function UpdateInsuranceDebt(Request $request, $id)
    {
        $debt = InsuranceDebt::find($id);

        $debt->amount = $request->amount;
        $debt->date = $request->date;

        $debt->save();

        return response()->json([
            'message'=>'تم تعديل الجين إلى التأمين',
            'debt'=>new MainInsuranceDebtResource($debt),
        ]);
    }

    public function payDebts(Request $request)
    {
        InsuranceDebt::whereIn('id',$request->insurance_debts)->update(['is_paid'=>true]);

        $tests = InsuranceDebt::whereIn('id',$request->insurance_debts)->get();

        return MainInsuranceDebtResource::collection($tests);
    }

    public function GetInsuranceDebts($id)
    {
        $debts = InsuranceDebt::where('insurance_id',$id)->get();

        return MainInsuranceDebtResource::collection($debts);
    }

    public function GetUnpaidInsuranceDebts($id)
    {
        $debts = InsuranceDebt::where('insurance_id',$id)->where('is_paid',false)->get();

        return MainInsuranceDebtResource::collection($debts);
    }

    public function GetAllDebts()
    {
        $debts = InsuranceDebt::all();

        return MainInsuranceDebtResource::collection($debts);
    }

    public function GetDebt($id)
    {
        $debt = InsuranceDebt::find($id);

        return new MainInsuranceDebtResource($debt);
    }

    public function GetIndebtedInsurances()
    {
        $debts = InsuranceDebt::where('is_paid',false)->get();
        $insurances_id = [];

        foreach($debts as $debt)
        {
            if(InsuranceDebtController::Find($debt->insurance_id,$insurances_id))
            {
                array_push($insurances_id,$debt->insurance_id);
            }
        }

        $insurances = Insurance::whereIn('id',$insurances_id)->get();

        return InsuranceResource::collection($insurances);
    }
}
