<?php

namespace App\Http\Controllers;

use App\GetBalance\GetBalance;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function GetBalance(Request $request)
    {
        $result = GetBalance::GetBalance($request,$request->from_date,$request->to_date);

        return $result;
    }

    public function GetProfit(Request $request)
    {
        $result = GetBalance::GetProfit($request,$request->from_date,$request->to_date);

        return $result;
    }

    public function GetLoses(Request $request)
    {
        $result = GetBalance::GetLoses($request,$request->from_date,$request->to_date);

        return $result;
    }

    public function GetPatientTestsProfit(Request $request)
    {
        $result = GetBalance::GetPatientTestsProfit($request,$request->from_date,$request->to_date);

        return $result;
    }

    public function GetPunishmentsProfit(Request $request)
    {
        $result = GetBalance::GetPunishmentsProfit($request->from_date,$request->to_date);

        return $result;
    }

    public function GetSalaryLoses(Request $request)
    {
        $result = GetBalance::GetSalaryLoses();

        return $result;
    }

    public function GetExpeseLoses(Request $request)
    {
        $result = GetBalance::GetExpenseLoses($request->from_date,$request->to_date);

        return $result;
    }

    public function GetRewardsLoses(Request $request)
    {
        $result = GetBalance::GetRewardsLoses($request->from_date,$request->to_date);

        return $result;
    }

    public function GetGrantsLoses(Request $request)
    {
        $result = GetBalance::GetGrantsLoses($request,$request->from_date,$request->to_date);

        return $result;
    }

    public function GetDebtLoses(Request $request)
    {
        $result = GetBalance::GetDebtLoses($request->from_date,$request->to_date);

        return $result;
    }

    public function GetPatientDebtsLoses(Request $request)
    {
        $result = GetBalance::GetPatientDebtsLoses($request->from_date,$request->to_date);

        return $result;
    }

    public function GetInsuranceDebtsLoses(Request $request)
    {
        $result = GetBalance::GetInsuranceDebtsLoses($request->from_date,$request->to_date);

        return $result;
    }

    public function GetOrganizationDebtsLoses(Request $request)
    {
        $result = GetBalance::GetOrganizationDebtsLoses($request->from_date,$request->to_date);

        return $result;
    }

}
