<?php

namespace App\Http\Controllers;

use App\Exports\ProductosExport;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->buscar){
            $productos = Producto::where('nombre','like', '%'.$request->buscar.'%' )
                                    ->orderBy("id", "desc")
                                    ->paginate(5);
            $categorias = Categoria::get();
    
            return view("admin.producto.listar", ["productos" => $productos, "categorias" => $categorias]);


        }else{
            // /producto?page=2
            $productos = Producto::orderBy("id", "desc")->paginate(5);
            $categorias = Categoria::get();
    
            return view("admin.producto.listar", ["productos" => $productos, "categorias" => $categorias]);

        }
    }

    public function exportarEnExcel(Request $request)
    {
        $precio = $request->precio;
        $fecha = $request->fecha;
        if(isset($precio)){
            return Excel::download(new ProductosExport($precio), 'productos.xlsx');
        }

        return Excel::download(new ProductosExport, 'productos.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::get();
        return view("admin.producto.nuevo", ["categorias" => $categorias]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validar
        $request->validate([
            "nombre" => "required|string",
            "categoria_id" => "required",
        ]);

        // subir imagen
        $ruta_imagen = "";
        if($file = $request->file("imagen")){
            $ruta_imagen =  time()."-". $file->getClientOriginalName();
            $file->move("imagenes", $ruta_imagen);

            $ruta_imagen = "imagenes/".$ruta_imagen;

        }

        // guardar
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->cantidad = $request->cantidad;
        $producto->categoria_id = $request->categoria_id;
        $producto->descripcion = $request->descripcion;
        $producto->imagen = $ruta_imagen;
        $producto->save();

        // redireccionar

        return redirect("/admin/producto")->with("mensaje","Producto registrado");
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
        $producto = Producto::findOrFail($id);

        $categorias = Categoria::get();

        return view("admin.producto.editar", compact("producto", "categorias"));
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
        

        // validar
        $request->validate([
            "nombre" => "required|string",
            "categoria_id" => "required",
        ]);

        // modificar
        $producto = Producto::findOrFail($id);
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;
        $producto->cantidad = $request->cantidad;
        $producto->categoria_id = $request->categoria_id;
        $producto->descripcion = $request->descripcion;
        $producto->update();

        
        // subir imagen
        $ruta_imagen = "";
        if($file = $request->file("imagen")){
            $ruta_imagen =  time()."-". $file->getClientOriginalName();
            $file->move("imagenes", $ruta_imagen);

            $ruta_imagen = "imagenes/".$ruta_imagen;

            $producto->imagen = $ruta_imagen;
            $producto->update();
        }

        // redireccionar

        return redirect("/admin/producto")->with("mensaje","Producto actualizado");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect("/admin/producto")->with("mensaje","Producto eliminado");
    }
}
