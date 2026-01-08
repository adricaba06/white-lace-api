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
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;  
use App\Models\WeddingMember;

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
Route::middleware('auth:sanctum')->get('/members', [WeddingMemberController::class, 'index']);
Route::middleware('auth:sanctum')->post('/members', [WeddingMemberController::class, 'store']);
Route::middleware('auth:sanctum')->put('/members/{member}', [WeddingMemberController::class, 'update']);
Route::middleware('auth:sanctum')->patch('/members/{member}', [WeddingMemberController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/members/{member}', [WeddingMemberController::class, 'destroy']);
Route::middleware('auth:sanctum')->get('/members/{id}', [WeddingMemberController::class, 'getById']);


Route::get('/weddings/{wedding}/members', [WeddingMemberController::class, 'getMembers']);

Route::middleware('auth:sanctum')->get(
    '/users/{user}/wedding-member',
    [WeddingMemberController::class, 'getByUserId']
);

//este endpoint es para ver los miembros de una boda concreta 
//---------------------

// Tasks
Route::middleware('auth:sanctum')->apiResource('tasks', TaskController::class);
//preguntar a miguel si esto es suficiente para cambiar el estado de la tarea 


// Tables -----------------------
Route::middleware('auth:sanctum')->apiResource('tables', WeddingTableController::class);

// Table assign 
Route::middleware('auth:sanctum')->get('/weddings/{wedding}/tables', [WeddingTableController::class, 'getTables']);

// Table assign 
Route::middleware('auth:sanctum')->get('/tables/{table}/members', [TableAssignmentController::class, 'getTableMembers']);
Route::middleware('auth:sanctum')->get('/tables/members/{weddingMemberId}', [TableAssignmentController::class, 'getTableAssignationByUserId']);


// Table Members - CRUD completo 
Route::middleware('auth:sanctum')->get('/tables/members', [TableAssignmentController::class, 'index']);          
Route::middleware('auth:sanctum')->post('/tables/members', [TableAssignmentController::class, 'store']);         
Route::middleware('auth:sanctum')->get('/tables/members/{tableAssignment}', [TableAssignmentController::class, 'show']);      
Route::middleware('auth:sanctum')->put('/tables/members/{tableAssignment}', [TableAssignmentController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/tables/members/{tableAssignment}', [TableAssignmentController::class, 'destroy']); 
//pictures------------
Route::middleware('auth:sanctum')->apiResource('pictures', WeddingPhotoController::class);

//asignacion comprobación
Route::middleware('auth:sanctum')->get(
    '/weddings/{weddingId}/members/unassigned',
    [WeddingMemberController::class, 'unassignedByWedding']
);


//base service / context
Route::middleware('auth:sanctum')->get('/wedding-member', function (Request $request) {
    $user = $request->user(); // usuario autenticado

    $weddingMember = WeddingMember::where('user_id', $user->id)->first();

    if (!$weddingMember) {
        return response()->json(['error' => 'No se encontró WeddingMember para este usuario'], 404);
    }
    
    return [
        'user_id' => $user->id,
        'wedding_id' => $weddingMember->wedding_id,
        'role' => $weddingMember->role,
        'status' => $weddingMember->status,
    ];
});
