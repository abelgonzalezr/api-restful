<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\FacturaController;

Route::apiResource('clientes', ClienteController::class);
Route::apiResource('articulos', ArticuloController::class);
Route::apiResource('pedidos', PedidoController::class);
Route::apiResource('facturas', FacturaController::class);
Route::apiResource('usuarios', UsuarioController::class);
