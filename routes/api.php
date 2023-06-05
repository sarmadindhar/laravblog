<?php

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
Route::get('/feeds',[\App\Http\Controllers\API\PostController::class,'index']);
Route::apiResource('/post',\App\Http\Controllers\API\PostController::class)
    ->only('store','destroy','update')
    ->middleware('auth:sanctum');
Route::post('/posts/like/{id}',[\App\Http\Controllers\API\PostController::class,'like'])->middleware('auth:sanctum');


