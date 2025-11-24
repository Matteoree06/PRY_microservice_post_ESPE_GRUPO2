<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Ruta por defecto de Sanctum
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//  Ruta de prueba protegida por tu middleware CheckAuthToken
Route::get('/posts', function () {
    return response()->json([
        'message' => 'Listado de posts (protegido por token)',
    ]);
});
