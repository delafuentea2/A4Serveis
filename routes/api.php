<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
// USERS
Route::post('login',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);
// PRODUCTS
Route::get('products',[Api\ProductController::class, 'index']);

Route::get('products/{id}',[Api\ProductController::class, 'show']);

/* PREUBAS DE PORQUE NO VA EL UPDATE PERO LO DEMÁS SI FUNCIONA */
Route::post('products/check/{id}',[Api\ProductController::class, 'checkUpdate']);
Route::get('products/check/{id}',[Api\ProductController::class, 'checkObject']);

Route::post('products/create',[Api\ProductController::class, 'store']);
Route::post('products/update/{id}',[Api\ProductController::class, 'update']);
Route::delete('products/delete/{id}',[Api\ProductController::class, 'destroy']);

//PROVIDERS
Route::get('providers',[Api\ProviderController::class,'index']);
Route::get('providers/{id}',[Api\ProviderController::class, 'show']);

Route::post('providers/create',[Api\ProviderController::class, 'store']);
Route::put('providers/update/{id}',[Api\ProviderController::class, 'update']);
Route::delete('providers/delete/{id}',[Api\ProviderController::class, 'destroy']);

