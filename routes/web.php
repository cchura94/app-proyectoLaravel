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
    
    // exportacion excel
    Route::get("/producto/exportar-excel", [ProductoController::class, "exportarEnExcel"])->name("producto_excel");
    
    // CRUD Usuarios
    // index, show, create, store, edit, update, destroy
    Route::resource("usuario", UserController::class);

    // CRUD Producto
    Route::resource("categoria", CategoriaController::class);
    // GET   /producto              producto.index
    // GET   /producto/create        producto.create
    // POST  /producto              producto.store
    // GET   /producto/{id}         producto.show
    // GET   /producto/{id}/edit    producto.edit
    // PUT   /producto/{id}         producto.update
    // DELETE /producto/{id}        producto.destroy
    Route::resource("producto", ProductoController::class);

    // CRUD Cliente
    Route::resource("clientes", ClienteController::class);
    Route::resource("producto", ProductoController::class);
    Route::resource("pedido", PedidoController::class);
    Route::resource("cliente", ClienteController::class);
    
    Route::get("/", function(){
        // resource/views/admin/admin.blade.php
        return view("admin.admin");
    })->middleware("auth");

});

