<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// API Routes para proyectos
Route::get('/proyectos', [ProyectoController::class, 'index']); // Listar todos los proyectos
Route::post('/proyectos', [ProyectoController::class, 'store']); // Agregar Proyecto
Route::get('/proyectos/{id}', [ProyectoController::class, 'show']); // Obtener un proyecto por su id
Route::put('/proyectos/{id}', [ProyectoController::class, 'update']); // Actualizar proyecto por su id
Route::delete('/proyectos/{id}', [ProyectoController::class, 'destroy']); // Eliminar proyecto por su Id