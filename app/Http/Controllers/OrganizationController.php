<?php

namespace App\Http\Controllers;

use App\Http\Resources\Organization as ResourcesOrganization;
use App\Models\Organization;
use Illuminate\Http\Request;


class OrganizationController extends Controller
{

    public function allaccounts(){
        $organization=Organization::all();
       if($organization->count() >0){
        return  Organization::collection($organization);
       }
       else{
        return  response()->json([
            'message'=>'لا يوجد جمعيات'
              ],);
       }

    

    }



public function create_organizationaccount(Request $request)
{
   $organization=new Organization();
   $organization->name=$request->name;
   $organization->save();
   return response()->json([
    'message'=>'تم انشأ الحساب بنجاح',
    'account'=>new ResourcesOrganization($organization)
      ]);  



}

public function update_organizationaccount(Request $request,$id)
{
    $organization=Organization::find($id);
   $organization->name=$request->name;
   $organization->save();
   return response()->json([
    'message'=>'تم تعديل الحساب بنجاح',
    'account'=>new ResourcesOrganization($organization),
      ],);  


}




}
