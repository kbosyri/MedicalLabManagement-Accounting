<?php

namespace App\Http\Controllers;

use App\Http\Requests\Debts\AddOrganizationDebtRequest;
use App\Http\Requests\Debts\PayOrganizationDebtRequest;
use App\Http\Requests\Debts\UpdateOrganizationDebtRequest;
use App\Models\OrganizationDebt;
use Illuminate\Http\Request;
use App\Http\Resources\Functionalaccount;
use App\Http\Resources\Organization\MainOrganizationDebtResource;
use App\Http\Resources\Organization\OrganizationDebtResource;
use App\Http\Resources\Organization\OrganizationResource;
use App\Models\Organization;

use function PHPUnit\Framework\returnSelf;

class Organization_deptsController extends Controller
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

    public function GetAllOrganizationDebts()
    {
        $funaccount = OrganizationDebt::all();
       if($funaccount->count() >0){
        return  MainOrganizationDebtResource::collection($funaccount);
       }
       else{
        return  response()->json([
            'message'=>'لا يوجد ديون مالية '
              ],500);
       }
    }


    public function AddOrganizationDebt(AddOrganizationDebtRequest $request)
    {

        $funaccount = new OrganizationDebt();

        $funaccount->organization_id=$request->organization_id;
        $funaccount->amount=$request->amount;
        $funaccount->date=$request->date;

        $funaccount->save();

        return response()->json([
            'message'=>'تم انشأ الحساب بنجاح',
            'debt'=>new MainOrganizationDebtResource($funaccount)
              ]); 

    }



    public function UpdateOrganizationDebt(UpdateOrganizationDebtRequest $request,$id)
    {

        $funaccount = OrganizationDebt::find($id);

        $funaccount->amount=$request->amount;
        $funaccount->date=$request->date;

        $funaccount->save();

        return response()->json([
        'message'=>'تم تعديل معلومات الحساب بنجاح',
        'debt'=> new MainOrganizationDebtResource($funaccount)
          ]);

    }

    public function payDebts(PayOrganizationDebtRequest $request)
    {
        OrganizationDebt::whereIn('id',$request->organization_debts)->update(['is_paid'=>true]);
        
        $tests = OrganizationDebt::whereIn('id',$request->organization_debts)->get();

        return MainOrganizationDebtResource::collection($tests);
    }

    public function PayOrganizationDebt($id)
    {
        $debt = OrganizationDebt::find($id);

        $debt->is_paid = true;

        $debt->save();

        return response()->json([
            'message'=>'تم دفع الدين',
            'debt'=>new MainOrganizationDebtResource($debt),
        ]);

    }

    public function GetUnpaidDebts($id)
    {
        $debts = OrganizationDebt::where('organization_id',$id)->where('is_paid',false)->get();

        return MainOrganizationDebtResource::collection($debts);
    }

    public function GetOrganizationDebts($id)
    {
        $debts = OrganizationDebt::where('organization_id',$id)->get();

        return MainOrganizationDebtResource::collection($debts);
    }

    public function GetDebt($id)
    {
        $debt = OrganizationDebt::find($id);

        return new MainOrganizationDebtResource($debt);
    }

    public function GetIndebtedOrganizations()
    {
        $debts = OrganizationDebt::where('is_paid',false)->get();
        $organizations_id = [];

        foreach($debts as $debt)
        {
            if(!Organization_deptsController::Find($debt->organization_id,$organizations_id))
            {
                array_push($organizations_id,$debt->organization_id);
            }
        }

        $organizations = Organization::whereIn('id',$organizations_id)->get();

        return OrganizationResource::collection($organizations);
    }
}