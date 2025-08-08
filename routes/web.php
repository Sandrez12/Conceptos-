<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaginaController;

Route::get('/', [PaginaController::class, 'index'])->name('home');
Route::get('/solid', [PaginaController::class, 'solid'])->name('solid');
Route::get('/cohesion-acoplamiento', [PaginaController::class, 'cohesionAcoplamiento'])->name('cohesion');
Route::get('/inyeccion-dependencias', [PaginaController::class, 'inyeccionDependencias'])->name('inyeccion');
Route::get('/bibliografia', [PaginaController::class, 'bibliografia'])->name('bibliografia');
