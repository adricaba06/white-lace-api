<?php

require __DIR__ . '/auth.php';

use App\Http\Controllers\UserController;
use App\Http\Controllers\WeddingController;
use App\Http\Controllers\WeddingMemberController;
use App\Http\Controllers\WeddingTableController;
use App\Http\Controllers\TableAssignmentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WeddingPhotoController;
use App\Http\Controllers\WeddingUserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/generate-token', function () {
//     $user = User::where('email', 'admin@example.com')->first();
//     if (!$user) {
//         return response()->json(['message' => 'User not found'], 404);
//     }
//     return $user->createToken('api-token')->plainTextToken;
// });


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('users', UserController::class);
    Route::apiResource('weddings', WeddingController::class);
    Route::apiResource('wedding-members', WeddingMemberController::class);
    Route::apiResource('wedding-tables', WeddingTableController::class);
    Route::apiResource('table-assignments', TableAssignmentController::class);
    Route::apiResource('tasks', TaskController::class);
    Route::apiResource('wedding-photos', WeddingPhotoController::class);

    //endpoints
    Route::get('/users-list', [WeddingUserController::class, 'index']);
    Route::post('/users', [WeddingUserController::class, 'store']);
    Route::delete('/users/{id}', [WeddingUserController::class, 'destroy']);
    Route::put('/users/{id}', [WeddingUserController::class, 'update']);

    Route::get('/weddings', [WeddingUserController::class, 'index']);
    Route::post('/weddings', [WeddingUserController::class, 'store']);
    Route::delete('/weddings/{id}', [WeddingUserController::class, 'destroy']);
    Route::put('/weddings/{id}', [WeddingUserController::class, 'update']);
    


});
