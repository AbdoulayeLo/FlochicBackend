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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::apiResource("produits",\App\Http\Controllers\ProduitController::class);
Route::apiResource("categories",\App\Http\Controllers\CategorieController::class);
Route::apiResource("commandes",\App\Http\Controllers\CommandeController::class);

Route::post('/register',[\App\Http\Controllers\AuthController::class,'register']);
Route::post('/login',[\App\Http\Controllers\AuthController::class,'login']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')
    ->group(function (){
        Route::post('/logout',[\App\Http\Controllers\AuthController::class,'logout']);
    });


