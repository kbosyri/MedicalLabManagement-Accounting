<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountAddRequest;
use App\Http\Resources\Insurance\InsuranceResource;
use App\Http\Resources\Organization\OrganizationResource;
use App\Http\Resources\Patients\PatientResource;
use App\Models\Insurance;
use App\Models\Organization;
use App\Models\Patient;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function AddInsurance(AccountAddRequest $request)
    {
        $new = new Insurance();

        $new->name = $request->name;
        $new->address = $request->address;
        $new->phone = $request->phone;
        $new->email = $request->email;

        $new->save();

        return response()->json([
            'message'=>'تم إضافة حساب التأمين بنجاح',
            'account'=>new InsuranceResource($new),
        ]);
    }

    public function AddOrganization(AccountAddRequest $request)
    {
        $new = new Organization();

        $new->name = $request->name;
        $new->address = $request->address;
        $new->phone = $request->phone;
        $new->email = $request->email;

        $new->save();

        return response()->json([
            'message'=>'تم تسجيل حساب الجمعية بنجاح',
            'account'=>new OrganizationResource($new),
        ]);
    }

    public function UpdateOrganization(Request $request, $id)
    {
        $organization = Organization::find($id);

        $organization->name = $request->name;
        $organization->address = $request->address;
        $organization->phone = $request->phone;
        $organization->email = $request->email;

        $organization->save();

        return response()->json([
            'message'=>'تم تعديل حساب الجمعية بنجاح',
            'account'=>new OrganizationResource($organization),
        ]);
    }

    public function UpdateInsurance(Request $request, $id)
    {
        $insurance = Insurance::find($id);

        $insurance->name = $request->name;
        $insurance->address = $request->address;
        $insurance->phone = $request->phone;
        $insurance->email = $request->email;

        $insurance->save();

        return response()->json([
            'message'=>'تم تعديل حساب التأمين بنجاح',
            'account'=>new InsuranceResource($insurance),
        ]);
    }

    public function GetAllOrganizations()
    {
        $orgs = Organization::all();

        return OrganizationResource::collection($orgs);
    }

    public function GetAllPatients()
    {
        $patients = Patient::all();

        return PatientResource::collection($patients);
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

    public function GetPatient($id)
    {
        $patient = Patient::find($id);

        return new PatientResource($patient);
    }
}
