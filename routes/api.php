<?php
    
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\ColocacionController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\UsuarioController;

Route::apiResource('clientes', ClienteController::class);
Route::apiResource('articulos', ArticuloController::class);
Route::apiResource('colocaciones', ColocacionController::class);
Route::apiResource('compras', CompraController::class);
Route::apiResource('usuarios', UsuarioController::class);
