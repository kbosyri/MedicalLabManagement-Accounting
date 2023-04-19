<?php

namespace App\Http\Controllers;

use App\Models\OrganizationDebt;
use Illuminate\Http\Request;
use App\Http\Resources\Functionalaccount;
use function PHPUnit\Framework\returnSelf;

class Organization_deptsController extends Controller
{


    public function allaccounts(){
        $funaccount=OrganizationDebt::all();
       if($funaccount->count() >0){
        return  Functionalaccount::collection($funaccount);
       }
       else{
        return  response()->json([
            'message'=>'لا يوجد حسابات مالية '
              ],500);
       }

    

    }


public function createfunctionalaccount(Request $request){
$funaccount=new OrganizationDebt();
$funaccount->organization_id=$request->organization_id;
$funaccount->amount=$request->amount;
$funaccount->date=$request->date;
$funaccount->save();

return response()->json([
    'message'=>'تم انشأ الحساب بنجاح',
      ],500); new Functionalaccount($funaccount); 

}



public function updatefunctionalaccount (Request $request,$id){
    $funaccount=OrganizationDebt::find($id);
    $funaccount=new OrganizationDebt();
$funaccount->organization_id=$request->organization_id;
$funaccount->amount=$request->amount;
$funaccount->date=$request->date;
$funaccount->save();
return response()->json([
    'message'=>'تم تعديل معلومات الحساب بنجاح',
      ],500); new Functionalaccount($funaccount); 

}
}