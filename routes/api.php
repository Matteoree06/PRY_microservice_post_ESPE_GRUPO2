<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// Ruta por defecto de Sanctum
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth.micro')->group(function () {
    Route::apiResource('posts', \App\Http\Controllers\PostController::class);
});


// Grupo de rutas para el recurso Post
Route::prefix('posts')->group(function () {
    Route::get('/index', [PostController::class, 'index']);          // GET /api/posts
    Route::post('/create', [PostController::class, 'create']);        // POST /api/posts
    Route::get('/show/{id}', [PostController::class, 'show']);       // GET /api/posts/{id}
    Route::put('/update/{id}', [PostController::class, 'update']);     // PUT /api/posts/{id}
    Route::delete('/delete/{id}', [PostController::class, 'destroy']); // DELETE /api/posts/{id}
});
