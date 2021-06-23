<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::group(['middleware'=>['jwt.verify']], function() {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);

    //INVOICES
    Route::get('invoices',[InvoicesController::class, 'index']);
    Route::get('invoices/{id}',[InvoicesController::class, 'show']);
    Route::post('invoices',[InvoicesController::class, 'store']);
    Route::post('invoices/{id}',[InvoicesController::class, 'update']);
    Route::get('invoices/delete/{id}',[InvoicesController::class, 'destroy']);
    Route::get('invoices/restore/{id}',[InvoicesController::class, 'restore']);
    Route::get('invoices/details/{id}',[InvoicesController::class, 'getDetails']);
    Route::get('execute',[InvoicesController::class, 'executeRobot']);
});