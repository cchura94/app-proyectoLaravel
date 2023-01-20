<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('welcome');
});

// Rutas de Registro de Usuario
Route::get("/registro", [AuthController::class, "registrarse"])->name("miRegistro");
Route::post("/registro", [AuthController::class, "guardarUsuario"])->name("guardarUsuario");
