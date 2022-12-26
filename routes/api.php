<?php

use App\Http\Controllers\api\ActorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Route::get('/actor/{id}', [ActorController::class, 'actor']); */
Route::get('/actor/{id}', [ActorController::class, 'actor']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

