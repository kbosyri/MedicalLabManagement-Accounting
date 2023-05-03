<?php

namespace App\Http\Controllers;

use App\Models\OrganizationDebt;
use Illuminate\Http\Request;
use App\Http\Resources\Organization_depts;
use App\Http\Resources\Organization;

use function PHPUnit\Framework\returnSelf;

class Organization_deptsController extends Controller
{


    public function allorganization_depts(){
        $organization_dept=OrganizationDebt::all();
       if($organization_dept->count() >0){
        return Organization::collection($organization_dept);
       }
       else{
        return  response()->json([
            'message'=>'لا يوجد جمعيات '
              ],);
       }
    }


public function createorganization_depts(Request $request){
$organization_dept=new OrganizationDebt();
$organization_dept->organization_id=$request->organization_id;
$organization_dept->amount=$request->amount;
$organization_dept->date=$request->date;
$organization_dept->save();

return response()->json([
    'message'=>'تم انشأ الحساب بنجاح',
    'account'=>new Organization_depts($organization_dept),
      ],);  

}



public function updateorganization_depts (Request $request,$id){
    $organization_dept=OrganizationDebt::find($id);
    $organization_dept=new OrganizationDebt();
$organization_dept->organization_id=$request->organization_id;
$organization_dept->amount=$request->amount;
$organization_dept->date=$request->date;
$organization_dept->save();
return response()->json([
    'message'=>'تم تعديل معلومات الحساب بنجاح',
    'account'=>new Organization_depts($organization_dept),

      ],); 
}
}