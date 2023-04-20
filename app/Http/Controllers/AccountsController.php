<?php

namespace App\Http\Controllers;

use App\Http\Resources\Insurance\InsuranceResource;
use App\Http\Resources\Organization\OrganizationResource;
use App\Models\Insurance;
use App\Models\Organization;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function AddInsurance(Request $request)
    {
        $new = new Insurance();

        $new->name = $request->name;

        $new->save();

        return response()->json([
            'message'=>'تم إضافة حساب التأمين بنجاح',
            'account'=>new InsuranceResource($new),
        ]);
    }

    public function AddOrganization(Request $request)
    {
        $new = new Organization();

        $new->name = $request->name;

        $new->save();

        return response()->json([
            'message'=>'تم تسجيل حساب الجمعية بنجاح',
            'account'=>new OrganizationResource($new),
        ]);
    }

    public function GetAllOrganizations()
    {
        $orgs = Organization::all();

        return OrganizationResource::collection($orgs);
    }

    public function GetAllInsurance()
    {
        $insurances = Insurance::all();

        return InsuranceResource::collection($insurances);
    }

    public function GetOrganization($id)
    {
        $org = Organization::find($id);

        return new OrganizationResource($org);
    }

    public function GetInsurance($id)
    {
        $insurance = Insurance::find($id);

        return new InsuranceResource($insurance);
    }
}
