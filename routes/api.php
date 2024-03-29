<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InsuranceDebtController;
use App\Http\Controllers\Organization_deptsController;
use App\Http\Controllers\PatientDebtsController;
use App\Http\Controllers\PunishmentsController;
use App\Http\Controllers\RewardsController;
use App\Http\Controllers\StaffSalaryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('/insurances',[AccountsController::class,'AddInsurance']);
    Route::post('/insurances/debts',[InsuranceDebtController::class,'AddInsuranceDebt']);
    Route::post('/insurances/debts/{id}/update',[InsuranceDebtController::class,'UpdateInsuranceDebt']);
    Route::post('/insurances/debts/pay',[InsuranceDebtController::class,'payDebts']);
    Route::post('/insurances/{id}',[AccountsController::class,'UpdateInsurance']);

    Route::post('/organizations',[AccountsController::class,'AddOrganization']);
    Route::post('/organizations/debts',[Organization_deptsController::class,'AddOrganizationDebt']);
    Route::post('/organizations/debts/{id}/update',[Organization_deptsController::class,'UpdateOrganizationDebt']);
    Route::post('/organizations/debts/pay',[Organization_deptsController::class,'payDebts']);
    Route::post('/organziations/{id}',[AccountsController::class,'UpdateOrganization']);

    Route::post('/patients/debts',[PatientDebtsController::class,'AddPatientDebt']);
    Route::post('/patients/debts/{id}/update',[PatientDebtsController::class,'UpdatePatientDebt']);
    Route::post('/patients/debts/pay',[PatientDebtsController::class,'PayDebts']);

    Route::middleware('check-auth')->group(function(){
        Route::get('/insurances',[AccountsController::class,'GetAllInsurance']);
        Route::get('/insurances/debts',[InsuranceDebtController::class,'GetAllDebts']);
        Route::get('/insurances/indebted',[InsuranceDebtController::class,'GetIndebtedInsurances']);
        Route::get('/insurances/{id}/debts',[InsuranceDebtController::class,'GetInsuranceDebts']);
        Route::get('/insurances/{id}/debts/unpaid',[InsuranceDebtController::class,'GetUnpaidInsuranceDebts']);
        Route::get('/insurances/debts/{id}',[InsuranceDebtController::class,'GetDebt']);
        Route::get('/insurances/{id}',[AccountsController::class,'GetInsurance']);
        
        Route::get('/organizations',[AccountsController::class,'GetAllOrganizations']);
        Route::get('/organizations/debts',[Organization_deptsController::class,'GetAllOrganizationDebts']);
        Route::get('/organizations/indebted',[Organization_deptsController::class,'GetIndebtedOrganizations']);
        Route::get('/organizations/{id}/debts',[Organization_deptsController::class,'GetOrganizationDebts']);
        Route::get('/organizations/{id}/debts/unpaid',[Organization_deptsController::class,'GetUnpaidDebts']);
        Route::get('/organizations/debts/{id}',[Organization_deptsController::class,'GetDebt']);
        Route::get('/organizations/{id}',[AccountsController::class,'GetOrganization']);

    });

    Route::middleware('check-auth-reception')->group(function(){
        Route::get('/patients',[AccountsController::class,'GetAllPatients']);
        Route::get('/patients/debts',[PatientDebtsController::class,'GetAllDebts']);
        Route::get('/patients/indebted',[PatientDebtsController::class,'GetIndebtedPatients']);
        Route::get('/patients/{id}/debts',[PatientDebtsController::class,'GetPatientDebts']);
        Route::get('/patients/{id}/debts/unpaid',[PatientDebtsController::class,'GetUnpaidPatientDebts']);
        Route::get('/patients/debts/{id}',[PatientDebtsController::class,'GetDebt']);
        Route::get('/patients/{id}',[AccountsController::class,'GetPatient']);
    });
    
});

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/expenses',[ExpenseController::class,'AddExpense']);
    Route::middleware('check-auth')->get('/expenses',[ExpenseController::class,'GetExpenses']);
    Route::get('/expenses/reports',[ExpenseController::class,'GetExpensesBetweenDates']);
    Route::middleware('check-auth')->get('/expenses/{id}',[ExpenseController::class,'GetExpense']);
});

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/staff/{id}/salary',[StaffSalaryController::class,'UpdateStaffSalary']);
});

Route::middleware(['auth:sanctum','check-auth'])->group(function(){
    Route::post('/rewards',[RewardsController::class,'AddReward']);
    Route::post('/rewards/{id}',[RewardsController::class,'UpdateReward']);
    Route::get('/staff/{id}/rewards',[RewardsController::class,'GetRewardsForStaff']);
    Route::get('/rewards',[RewardsController::class,'GetAllRewards']);
    Route::get('/rewards/report',[RewardsController::class,'RewardsReport']);
    Route::get('/rewards/{id}',[RewardsController::class,'GetReward']);
});

Route::middleware(['auth:sanctum','check-auth'])->group(function(){
    Route::post('/punishments',[PunishmentsController::class,'AddPunishment']);
    Route::post('/punishments/{id}',[PunishmentsController::class,'UpdatePunishment']);
    Route::get('/staff/{id}/punishments',[PunishmentsController::class,'GetPunishmentsForStaff']);
    Route::get('/punishments',[PunishmentsController::class,'GetAllPunishments']);
    Route::get('/punishments/report',[PunishmentsController::class,'PunishmentsReport']);
    Route::get('/punishments/{id}',[PunishmentsController::class,'GetPunishment']);
});

Route::middleware(['auth:sanctum','check-auth'])->group(function(){
    Route::get('/balance',[BalanceController::class,'GetBalance']);
    Route::get('/balance/profits',[BalanceController::class,'GetProfit']);
    Route::get('/balance/profits/tests',[BalanceController::class,'GetPatientTestsProfit']);
    Route::get('/balance/profits/punishments',[BalanceController::class,'GetPunishmentsProfit']);
    Route::get('/balance/loses',[BalanceController::class,'GetLoses']);
    Route::get('/balance/loses/salaries',[BalanceController::class,'GetSalaryLoses']);
    Route::get('/balance/loses/expenses',[BalanceController::class,'GetExpeseLoses']);
    Route::get('/balance/loses/rewards',[BalanceController::class,'GetRewardsLoses']);
    Route::get('/balance/loses/grants',[BalanceController::class,'GetGrantsLoses']);
    Route::get('/balance/loses/debts',[BalanceController::class,'GetDebtLoses']);
    Route::get('/balance/loses/debts/patients',[BalanceController::class,'GetPatientDebtsLoses']);
    Route::get('/balance/loses/debts/insurances',[BalanceController::class,'GetInsuranceDebtsLoses']);
    Route::get('/balance/loses/debts/organizations',[BalanceController::class,'GetOrganizationDebtsLoses']);
});

/*Route::get('/allaccounts',[Organization_deptsController::class,'allaccounts']);
Route::get('/allorganization_depts',[Organization_deptsController::class,'allorganization_deptsallaccounts']);
Route::post('/createorganization_depts',[Organization_deptsController::class,'creatorganization_depts']);
 Route::post('/updateorganization_depts/{id}',[OrganizationController::class,'updateorganization_depts']);



Route::get('/allaccounts',[OrganizationController::class,'allaccounts']);
Route ::post('/create_organizationaccount',[OrganizationController::class,'create_organizationaccount']);
 Route::post('/update_organizationaccount/{id}',[OrganizationController::class,'update_organizationaccount']);



 Route::get('/allinsurances',[InsuranceController::class,'allinsurances']);
Route ::post('/create_insuranceaccount',[InsuranceController::class,'create_insuranceaccount']);
 Route::post('/update_insuranceaccount/{id}',[InsuranceController::class,'update_insuranceaccount']);


 Route::get('/allinsurances_depts',[Insurance_deptsController::class,'allinsurances_depts']);
Route::post('/createinsurance_depts',[Insurance_deptsController::class,'createinsurance_depts']);
 Route::post('/updateinsurance_depts/{id}',[Insurance_deptsController::class,'updateinsurance_depts']);*/