<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\InsuranceDebtController;
use App\Http\Controllers\Organization_deptsController;
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
    Route::post('/organizations',[AccountsController::class,'AddOrganization']);
    Route::post('/organizations/debts',[Organization_deptsController::class,'AddOrganizationDebt']);
    Route::post('/organizations/debts/{id}/update',[Organization_deptsController::class,'UpdateOrganizationDebt']);
    Route::post('/organizations/debts/pay',[Organization_deptsController::class,'payDebts']);

    Route::get('/insurances',[AccountsController::class,'GetAllInsurance']);
    Route::get('/insurances/debts',[InsuranceDebtController::class,'GetAllDebts']);
    Route::get('/insurances/{id}/debts',[InsuranceDebtController::class,'GetInsuranceDebts']);
    Route::get('/insurances/{id}/debts/unpaid',[InsuranceDebtController::class,'GetUnpaidInsuranceDebts']);
    Route::get('/insurances/{id}',[AccountsController::class,'GetInsurance']);
    Route::get('/organizations',[AccountsController::class,'GetAllOrganizations']);
    Route::get('/organizations/debts',[Organization_deptsController::class,'GetAllOrganizationDebts']);
    Route::get('/organizations/{id}/debts',[Organization_deptsController::class,'GetOrganizationDebts']);
    Route::get('/organizations/{id}/debts/unpaid',[Organization_deptsController::class,'GetUnpaidDebts']);
    Route::get('/organizations/{id}',[AccountsController::class,'GetOrganization']);
});

/*Route::get('/allaccounts',[Organization_deptsController::class,'allaccounts']);

Route::post('/createfunctionalaccount',[Organization_deptsController::class,'creatfunctionalaccount']);
 Route::post('/updatefunctionalaccount/{id}',[OrganizationController::class,'updatefunctionalaccount']);*/