<?php

namespace App\GetBalance;

use App\Http\Resources\Expenses\ExpenseResource;
use App\Http\Resources\Punishments\PunishmentResource;
use App\Http\Resources\StaffResource;
use App\Models\PatientTest;
use App\Models\Punishment;
use Illuminate\Support\Facades\Http;
use App\Models\Expense;
use App\Models\Reward;
use App\Models\Staff;
use Illuminate\Http\Request;

class GetBalance
{
    public static function GetBalance(Request $request,$from_date,$to_date)
    {
        $balance = [];
        $balance['profit'] = GetBalance::GetProfit($request,$from_date,$to_date);
        $balance['lose'] = GetBalance::GetLoses($request,$from_date,$to_date);
        $balance['balance'] = $balance['profit']['total_profit'] - $balance['lose']['total_loses'];

        return $balance;
    }

    public static function GetProfit(Request $request,$from_date,$to_date)
    {
        $test_results = GetBalance::GetPatientTestsProfit($request,$from_date,$to_date);
        $punishment_results = GetBalance::GetPunishmentsProfit($from_date,$to_date);

        $total_results = [];

        $total_results['test_profit'] = $test_results;
        $total_results['punishment_profit'] = $punishment_results;
        $total_results['total_profit'] = $total_results['test_profit']['profit'] + $total_results['punishment_profit']['profit'];


        return $total_results;
    }

    public static function GetPatientTestsProfit(Request $request,$from_date,$to_date)
    {
        $profit = 0;
        $tests = Http::withToken($request->bearerToken())->withBody(json_encode([
            'start_date'=>$from_date,
            'end_date'=>$to_date
        ]),"application/json")->get("http://localhost:8000/api/reports/patients/tests");

        foreach($tests['data'] as $test)
        {
            $profit = $profit + $test['test']['cost'];
        }

        $results = [];
        $results['tests'] = $tests['data'];
        $results['profit'] = $profit;

        return $results;
    }

    public static function GetPunishmentsProfit($from_date,$to_date)
    {
        $profit = 0;
        $punishments = Punishment::whereBetween('date',[$from_date,$to_date])->get();
        foreach($punishments as $punishment)
        {
            $profit = $profit + $punishment->amount;
        }

        $results = [];
        $results['punishments'] = PunishmentResource::collection($punishments);
        $results['profit'] = $profit;

        return $results;
    }

    public static function GetLoses(Request $request,$from_date,$to_date)
    {
        $total_loses = [];
        $total_loses['expense_loses'] = GetBalance::GetExpenseLoses($from_date,$to_date);
        $total_loses['salary_loses'] = GetBalance::GetSalaryLoses();
        $total_loses['rewards_loses'] = GetBalance::GetRewardsLoses($from_date,$to_date);
        $total_loses['grant_loses'] = GetBalance::GetGrantsLoses($request,$from_date,$to_date);
        $total_loses['total_loses'] = $total_loses['expense_loses']['lose'] 
                                        + $total_loses['salary_loses']['lose']
                                        + $total_loses['rewards_loses']['lose']
                                        + $total_loses['grant_loses']['lose'];

        return $total_loses;
    }

    public static function GetExpenseLoses($from_date,$to_date)
    {
        $loses = 0;
        $expenses = Expense::whereBetween('date',[$from_date,$to_date])->get();

        foreach($expenses as $expense)
        {
            $loses = $loses + $expense->amount;
        }

        $result = [];
        $result['expenses'] = ExpenseResource::collection($expenses);
        $result['lose'] = $loses;

        return $result;
    }

    public static function GetSalaryLoses()
    {
        $loses = 0;
        $staff = Staff::where('is_active',true)->get();

        foreach($staff as $member)
        {
            $loses = $loses + $member->salary;
        }

        $result = [];
        $result['expenses'] = StaffResource::collection($staff);
        $result['lose'] = $loses;

        return $result;
    }

    public static function GetRewardsLoses($from_date,$to_date)
    {
        $loses = 0;
        $rewards = Reward::whereBetween('date',[$from_date,$to_date])->get();

        foreach($rewards as $reward)
        {
            $loses = $loses + $reward->amount;
        }

        $result = [];
        $result['rewards'] = ExpenseResource::collection($rewards);
        $result['lose'] = $loses;

        return $result;
    }

    public static function GetGrantsLoses(Request $request,$from_date,$to_date)
    {
        $loses = 0;
        $grants = Http::withToken($request->bearerToken())->withBody(json_encode([
            'from_date'=>$from_date,
            'to_date'=>$to_date
        ]),'application/json')->get("http://localhost:8002/api/grants/report");

        foreach($grants['data'] as $grant)
        {
            $loses = $loses + $grant['amount'];
        }

        $result = [];
        $result['grants'] = $grants['data'];
        $result['lose'] = $loses;

        return $result;
    }
}