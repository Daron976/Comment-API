<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
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

//public
Route::post('/signup', [AuthController::class, 'signup']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/comments', [CommentController::class, 'index']);

//protected
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/comments', [CommentController::class, 'store']);
    Route::put('/comments/{id}', [CommentController::class, 'update']);
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']);
    Route::post('/ogout', [AuthController::class, 'logout']);
});
