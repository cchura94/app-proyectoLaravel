<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

// Rutas de Registro de Usuario
Route::get("/registro", [AuthController::class, "registrarse"])->name("register");
Route::post("/registro", [AuthController::class, "guardarUsuario"])->name("guardarUsuario");

// Ruta para login (Auth)
Route::get("/login", [AuthController::class, "formLogin"])->name("login");
Route::post("/login", [AuthController::class, "login"])->name("ingresar");

// Cerrar sesion
Route::post("/salir", [AuthController::class, "logout"])->name("logout");

// lista de usuarios con Datatables (Ajax)
Route::get("/usuarios-dt", [UserController::class, "listaUsuariosDT"])->name("listaUsuariosDT");
// CRUD Usuarios
// index, show, create, store, edit, update, destroy
Route::resource("usuario", UserController::class);

Route::get("/admin", function(){
    // resource/views/admin/admin.blade.php
    return view("admin.admin");
})->middleware("auth");
