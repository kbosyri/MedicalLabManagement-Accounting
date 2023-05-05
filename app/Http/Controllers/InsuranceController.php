<?php

namespace App\Http\Controllers;

use App\Http\Resources\Insurance as ResourcesInsurance;
use App\Models\Insurance;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    public function allinsurances()
    {
        $insurance=Insurance::all();
        if($insurance->count() >0){
         return  Insurance::collection($insurance);
        }
        else{
         return  response()->json([
             'message'=> ' لا يوجد شركات'
               ],);
        }
    }

    public function create_insuranceaccount(Request $request)
    {
       $insurance=new Insurance();
       $insurance->name=$request->name;
       $insurance->save();
       return response()->json([
        'message'=>'تم انشأ الحساب بنجاح',
        'accont'=>new ResourcesInsurance($insurance),
          ],);  
    
    
    
    }


    public function update_insuranceaccount(Request $request)
    {
       $insurance=new Insurance();
       $insurance->name=$request->name;
       $insurance->save();
       return response()->json([
        'message'=>'تم تعديل الحساب بنجاح',
        'accont'=>new ResourcesInsurance($insurance),
          ],);  
    
    
    
    }




}
