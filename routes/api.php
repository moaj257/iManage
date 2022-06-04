<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\ConditionController;

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
Route::get('password', function() {
    return bcrypt('password');
});
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('/me', function (Request $request) {
        return $request->user();
    });
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::resource('/manufacturer', ManufacturerController::class);
Route::resource('/model', ModelController::class);
Route::resource('/condition', ConditionController::class);