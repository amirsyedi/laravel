<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

//public route
Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);

//protected route
Route::group(['middleware'=>'auth:sanctum'], function(){
    Route::get('/index',[UserController::class,'index']);
    Route::post('/delete/{id}',[UserController::class,'delete']);
    Route::get('/edit/{id}',[UserController::class,'edit']);
    Route::post('/update/{id}',[UserController::class,'update']);
    Route::get('/getTask',[TaskController::class,'getTask']);
    Route::post('/deleteTask/{id}',[TaskController::class,'delete']);
    Route::post('/createTask',[TaskController::class,'createTask']);
    Route::post('/logout',[AuthController::class, 'logout']);
    Route::get('/editTask/{id}',[TaskController::class,'editTask']);
    Route::post('/updateTask/{id}',[TaskController::class,'updateTask']);
    Route::post('/updateStatus/{id}',[TaskController::class,'updateStatus']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request){
    return $request->user();
});
