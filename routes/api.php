<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to Laravel API Starter'
    ]);
});

// Endpoint para probar la conexión a la base de datos
Route::get('/testdb', function () {
    try {
        // Realiza una consulta simple para probar la conexión
        DB::connection()->getPdo();
        return response()->json([
            'message' => 'Conexión a la base de datos exitosa',
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error al conectar con la base de datos: ' . $e->getMessage(),
        ], 500);
    }
});


Route::apiResource('tasks', TaskController::class);
Route::apiResource('users', UserController::class);