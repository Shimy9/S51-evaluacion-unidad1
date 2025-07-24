<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;

Route::get('/', function () {
    return view('welcome');
});


// Rutas WEB para proyectos (para las vistas)
Route::get('/proyectos', [ProyectoController::class, 'indexWeb'])->name('proyectos.index');
Route::get('/proyectos/crear', [ProyectoController::class, 'createWeb'])->name('proyectos.create');
Route::post('/proyectos', [ProyectoController::class, 'storeWeb'])->name('proyectos.store');
Route::get('/proyectos/{id}', [ProyectoController::class, 'showWeb'])->name('proyectos.show');
Route::get('/proyectos/{id}/editar', [ProyectoController::class, 'editWeb'])->name('proyectos.edit');
Route::put('/proyectos/{id}', [ProyectoController::class, 'updateWeb'])->name('proyectos.update');
Route::delete('/proyectos/{id}', [ProyectoController::class, 'destroyWeb'])->name('proyectos.destroy');