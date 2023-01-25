<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Cargar el form de registro de usuarios
     */
    public function registrarse()
    {
        // resources/views/auth/registro.blade.php
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
        return redirect("/login");
    }

    public function formLogin()
    {
        // resources/views/auth/login.blade.php
        return view("auth.login");
    }

    public function login(Request $request)
    {
        // validar
        $credenciales = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        // autenticar
        if(Auth::attempt($credenciales)){
            $request->session()->regenerate();
 
            return redirect()->intended('admin');
        }

        // redirect
        return redirect()->back();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
 
        $request->session()->regenerateToken();
     
        return redirect('/login');
    }
}
