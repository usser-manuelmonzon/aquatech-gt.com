<?php

use App\Http\Controllers\ContactoController;
use App\Http\Controllers\ConsultaReciboController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\QuienesSomosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas públicas de AquaTech GT
|--------------------------------------------------------------------------
*/

Route::get(
    '/',
    [InicioController::class, 'index']
)->name('inicio');

Route::get(
    '/consulta-recibos',
    [ConsultaReciboController::class, 'index']
)->name('recibos.consulta');

Route::post(
    '/consulta-recibos',
    [ConsultaReciboController::class, 'consultar']
)->name('recibos.consultar');

Route::get(
    '/quienes-somos',
    [QuienesSomosController::class, 'index']
)->name('quienes-somos');

Route::get(
    '/contacto',
    [ContactoController::class, 'index']
)->name('contacto');