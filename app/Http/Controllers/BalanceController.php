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
}
