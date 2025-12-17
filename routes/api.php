<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\WeddingUserController;
use App\Http\Controllers\WeddingController;
use App\Http\Controllers\WeddingMemberController;
use App\Http\Controllers\WeddingTableController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TableAssignmentController;
use App\Http\Controllers\WeddingPhotoController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

//user----------------------
Route::middleware('auth:sanctum')->get('/users', [WeddingUserController::class, 'index']);
Route::middleware('auth:sanctum')->get('/users/{user}', [WeddingUserController::class, 'show']);
Route::middleware('auth:sanctum')->delete('/users/{user}', [WeddingUserController::class, 'destroy']);
Route::middleware('auth:sanctum')->put('/users/{user}', [WeddingUserController::class, 'update']);
//---------------------------

//weddings-----------------
Route::middleware('auth:sanctum')->apiResource('weddings', WeddingController::class);
//------------------

//members--------------
Route::middleware('auth:sanctum')->apiResource('members', WeddingMemberController::class);
Route::get('/weddings/{wedding}/members', [WeddingMemberController::class, 'getMembers']);
//este endpoint es para ver los miembros de una boda concreta 
//---------------------

// Tasks
Route::middleware('auth:sanctum')->apiResource('tasks', TaskController::class);
//preguntar a miguel si esto es suficiente para cambiar el estado de la tarea 


// tables -----------------------
Route::middleware('auth:sanctum')->apiResource('tables', WeddingTableController::class);

// table assign
Route::middleware('auth:sanctum')->get('/weddings/{wedding}/tables', [WeddingTableController::class, 'getTables']);

Route::middleware('auth:sanctum')->get('/tables/{table}/members', [TableAssignmentController::class, 'getTableMembers']);

//pictures------------
Route::middleware('auth:sanctum')->apiResource('pictures', WeddingPhotoController::class);
