<?php

use App\Http\Controllers\PatientController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\GenderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/test', function () {
//     return "Hello world";
// });

Route::Resource(name:'patients', controller:PatientController::class);
Route::Resource(name:'documentType', controller:DocumentTypeController::class);
Route::Resource(name:'genders', controller:GenderController::class);


