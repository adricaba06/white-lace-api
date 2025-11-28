<?php
require __DIR__ . '/auth.php';

use App\Http\Controllers\SecuenciaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WeddingController;
use App\Http\Controllers\WeddingMemberController;
use App\Http\Controllers\WeddingTableController;
use App\Http\Controllers\TableAssignmentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\WeddingPhotoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('users', UserController::class);
    Route::apiResource('weddings', WeddingController::class);
    Route::apiResource('wedding-members', WeddingMemberController::class);
    Route::apiResource('wedding-tables', WeddingTableController::class);
    Route::apiResource('table-assignments', TableAssignmentController::class);
    Route::apiResource('tasks', TaskController::class);
    Route::apiResource('wedding-photos', WeddingPhotoController::class);

});
