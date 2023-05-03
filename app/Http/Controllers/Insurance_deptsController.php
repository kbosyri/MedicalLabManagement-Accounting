<?php

namespace App\Http\Controllers;

use App\Http\Resources\Insurance_depts;
use App\Models\InsuranceDebt;
use Illuminate\Http\Request;

class Insurance_deptsController extends Controller
{
    public function allinsurances_depts(){
        $insurance_dept=InsuranceDebt::all();
       if($insurance_dept->count() >0){
        return Insurance_depts::collection($insurance_dept);
       }
       else{
        return  response()->json([
            'message'=>'لا يوجد شركات تأمين'
              ],);
       }

    }

    public function createinsurance_depts(Request $request){
        $insurance_dept=new InsuranceDebt();
        $insurance_dept->insurance_id=$request->insurance_id;
        $insurance_dept->amount=$request->amount;
        $insurance_dept->date=$request->date;
        $insurance_dept->save();
        
        return response()->json([
            'message'=>'تم انشأ الحساب بنجاح',
            'account'=>new Insurance_depts($insurance_dept),
              ],);  
        
        }


        public function updateinsurance_depts(Request $request,$id){
            $insurance_dept=InsuranceDebt::find($id);
            $insurance_dept=new InsuranceDebt();
            $insurance_dept->insurance_id=$request->insurance_id;
            $insurance_dept->amount=$request->amount;
            $insurance_dept->date=$request->date;
            $insurance_dept->save();
            
            return response()->json([
                'message'=>'تم تعديل الحساب بنجاح',
                'account'=>new Insurance_depts($insurance_dept),

                  ],);
            
            }


}
