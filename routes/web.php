<?php

use App\Http\Controllers\PaginaController;
use Illuminate\Support\Facades\Route;

Route::controller(PaginaController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/solid', 'solid')->name('solid');
    Route::get('/cohesion-acoplamiento', 'cohesionAcoplamiento')->name('cohesion');
    Route::get('/inyeccion-dependencias', 'inyeccionDependencias')->name('inyeccion');
    Route::get('/bibliografia', 'bibliografia')->name('bibliografia');
});
