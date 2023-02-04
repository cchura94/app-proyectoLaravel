<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::orderBy('id', 'desc')->paginate();

        return view('admin.pedido.lista', compact('pedidos'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.pedido.nuevo");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "cliente_id" => "required"
        ]);

        $cod_pedido = Pedido::generateInvoiceNumber();

        // guarda el pedido
        $pedido = new Pedido();
        $pedido->cod_pedido = $cod_pedido;
        $pedido->cliente_id = $request->cliente_id;
        $pedido->fecha = date('Y-m-d H:i:s');
        $pedido->estado = 1;
        $pedido->save();

        $carrito = $request->carrito;

        foreach ($carrito as $prod) {
            $pedido->productos()->attach($prod["id"], ["cantidad" => $prod["cantidad"]]);
        }

        $pedido->estado = 2;
        $pedido->update();
        
        return response()->json(["mensaje" => "Pedido Registrado"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
