<?php

namespace App\Http\Controllers;

use App\GetBalance\GetBalance;
use App\Http\Requests\Balance\BalanceRequest;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function GetBalance(BalanceRequest $request)
    {
        $result = GetBalance::GetBalance($request,$request->from_date,$request->to_date);

        return $result;
    }

    public function GetProfit(BalanceRequest $request)
    {
        $result = GetBalance::GetProfit($request,$request->from_date,$request->to_date);

        return $result;
    }

    public function GetLoses(BalanceRequest $request)
    {
        $result = GetBalance::GetLoses($request,$request->from_date,$request->to_date);

        return $result;
    }

    public function GetPatientTestsProfit(BalanceRequest $request)
    {
        $result = GetBalance::GetPatientTestsProfit($request,$request->from_date,$request->to_date);

        return $result;
    }

    public function GetPunishmentsProfit(BalanceRequest $request)
    {
        $result = GetBalance::GetPunishmentsProfit($request->from_date,$request->to_date);

        return $result;
    }

    public function GetSalaryLoses(BalanceRequest $request)
    {
        $result = GetBalance::GetSalaryLoses();

        return $result;
    }

    public function GetExpeseLoses(Request $request)
    {
        $result = GetBalance::GetExpenseLoses($request->from_date,$request->to_date);

        return $result;
    }

    public function GetRewardsLoses(BalanceRequest $request)
    {
        $result = GetBalance::GetRewardsLoses($request->from_date,$request->to_date);

        return $result;
    }

    public function GetGrantsLoses(Request $request)
    {
        $result = GetBalance::GetGrantsLoses($request,$request->from_date,$request->to_date);

        return $result;
    }

    public function GetDebtLoses(BalanceRequest $request)
    {
        $result = GetBalance::GetDebtLoses($request->from_date,$request->to_date);

        return $result;
    }

    public function GetPatientDebtsLoses(BalanceRequest $request)
    {
        $result = GetBalance::GetPatientDebtsLoses($request->from_date,$request->to_date);

        return $result;
    }

    public function GetInsuranceDebtsLoses(BalanceRequest $request)
    {
        $result = GetBalance::GetInsuranceDebtsLoses($request->from_date,$request->to_date);

        return $result;
    }

    public function GetOrganizationDebtsLoses(BalanceRequest $request)
    {
        $result = GetBalance::GetOrganizationDebtsLoses($request->from_date,$request->to_date);

        return $result;
    }

}
