<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

Route::post('/users/login', [UserController::class, 'login']);

Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});
Route::middleware('auth:sanctum')->group(function () {
// Route::get('/task', ApiTaskController);
Route::apiResource('/tasks', TaskController::class);
Route::apiResource('/users', UserController::class);
// use the show api
// Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
Route::get('/tasks/{id}', [TaskController::class, 'show.task']);

// use store api
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);

});
// use login api2
        

// use auth to login the user

