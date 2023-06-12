<?php

namespace App\Http\Controllers;

use App\Http\Requests\Expenses\ExpenseRequest;
use App\Http\Requests\Expenses\ExpensesReportRequest;
use App\Http\Resources\Expenses\ExpenseResource;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function AddExpense(ExpenseRequest $request)
    {
        $expense = new Expense();

        $expense->reason = $request->reason;
        $expense->amount = $request->amount;
        $expense->date = $request->date;

        $expense->save();

        return response()->json([
            'message'=>'تم إضافة التكلفة إلى النظام',
            'expense'=>new ExpenseResource($expense)
        ]);
    }

    public function GetExpenses()
    {
        $expenses = Expense::all();

        return ExpenseResource::collection($expenses);
    }

    public function GetExpense($id)
    {
        $expense = Expense::find($id);

        return new ExpenseResource($expense);
    }

    public function GetExpensesBetweenDates(ExpensesReportRequest $request)
    {

        $expenses = Expense::whereBetween('date',[$request->from_date,$request->to_date])->orderBy('date','desc')->get();

        return ExpenseResource::collection($expenses);
    }
}
