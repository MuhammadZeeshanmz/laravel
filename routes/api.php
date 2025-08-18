<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\CountryController;
Route::post('/users/login', [UserController::class, 'login']);
Route::post('/country/store', [CountryController::class, 'store']);
Route::get('/country/show/{id}', [CountryController::class, 'show']);

Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});
Route::middleware('auth:sanctum')->group(function () {
// Route::get('/task', ApiTaskController);
Route::apiResource('/tasks', TaskController::class);
Route::apiResource('/users', UserController::class);
// use the show api
// Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
// Route::get('/tasks/{id}', [TaskController::class, 'show.task']);

// use store api
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);

// Route::post('/countries', [LocationController::class, 'getCountries']);
// Route::get('/country/{id}', [LocationController::class, 'getCountryDetails']);
// Route::get('/country/{country_id}/states', [LocationController::class, 'getStatesByCountry']);
// Route::get('/state/{state_id}/cities', [LocationController::class, 'getCitiesByState']);




});
// use login api2
        

// use auth to login the user

