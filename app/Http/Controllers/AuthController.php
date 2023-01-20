<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Cargar el form de registro de usuarios
     */
    public function registrarse()
    {
        return view("auth.registro");
    }

    public function guardarUsuario(Request $request)
    {
        // validar
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required",
            "c_password" => "required|same:password"
        ]);
        // guardar
        $u = new User;
        $u->name = $request->name;
        $u->email = $request->email;
        $u->password = bcrypt($request->password);
        $u->save();       

        // redireccionar
        return redirect("/");
    }
}
