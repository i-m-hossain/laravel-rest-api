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

Route::get('/notLoggedIn', function () {
    return ["message" => "you are not logged in"];
});

// api/v1
Route::group((['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1', 'middleware' => 'auth:sanctum']), function () {
    Route::apiResources([
        'customers' => CustomerController::class,
        'invoices' => InvoiceController::class
    ]);
    Route::post('invoices/bulk', ['uses' => 'InvoiceController@bulkStore']);

});
