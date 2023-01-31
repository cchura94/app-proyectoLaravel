<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProductoController;
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


Route::group(["prefix"=> "admin"], function(){

    // lista de usuarios con Datatables (Ajax)
    Route::get("usuarios-dt", [UserController::class, "listaUsuariosDT"])->name("listaUsuariosDT");
    // CRUD Usuarios
    // index, show, create, store, edit, update, destroy
    Route::resource("usuario", UserController::class);

    // CRUD Producto
    Route::resource("categoria", CategoriaController::class);
    Route::resource("producto", ProductoController::class);
    Route::resource("pedido", PedidoController::class);
    Route::resource("cliente", ClienteController::class);
    
    Route::get("/", function(){
        // resource/views/admin/admin.blade.php
        return view("admin.admin");
    })->middleware("auth");

});

