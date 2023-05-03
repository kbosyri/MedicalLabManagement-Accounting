<?php

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
 Route::post('/updateinsurance_depts/{id}',[Insurance_deptsController::class,'updateinsurance_depts']);