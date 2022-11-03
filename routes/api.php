<?php

use App\Http\Controllers\api\RouteController;
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

//GET
Route::get('product/list',[RouteController::class,'productList']);
Route::get('user/list',[RouteController::class,'userList']);


//POST
Route::post('create/data',[RouteController::class,'createData']);
Route::post('create/contact',[RouteController::class,'createContact']);
Route::post('create/user',[RouteController::class,'createUser']);

//delete
Route::get('delete/category/{id}',[RouteController::class,'deleteCategory']);
Route::post('delete/user',[RouteController::class,'deleteUser']);

// update
Route::get('product/details',[RouteController::class,'productDetails']);
Route::get('product/details/{id}',[RouteController::class,'productDetail']);
Route::post('update/user',[RouteController::class,'updateUser']);


