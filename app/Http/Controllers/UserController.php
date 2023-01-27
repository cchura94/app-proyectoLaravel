<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // listar
        // select * from users
        $usuarios = User::all();
        return view("admin.usuario.listar", compact("usuarios"));
    }

    public function listaUsuariosDT(Request $request)
    {
        if($request->ajax()){
            $data = User::latest()->get();
            return DataTables::of($data)
                                ->addIndexColumn()
                                ->addColumn('accion', function($row){
                                    $botones = '<a href="javascript:void(0)">Editar</a><a href="javascript:void(0)">Eliminar</a>';
                                })
                                ->rawColumns(['accion'])
                                ->make(true);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // cargar el form de creacion

        return view("admin.usuario.nuevo");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // guardar en la BD
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // mostrar un recurso por id
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // mostrar un form de edicion por recurso
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // actualizar la infor de recurso en la bd
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // eliminar un recurso por id en la BD
    }
}
