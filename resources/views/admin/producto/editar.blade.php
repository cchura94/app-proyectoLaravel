@extends("layouts.admin")

@section("titulo", "Editar Producto")

@section("contenedor")

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                <form action="{{route('producto.update', $producto->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")

                    <label for="nom">Nombre Producto</label>
                    <input type="text" id="nom" name="nombre" value="{{ $producto->nombre }}" required class="form-control @error('nombre') is-invalid @enderror">
                    @error('nombre')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <label for="pr">Precio</label>
                    <input type="number" step="0.01" id="pr" name="precio" value="{{ $producto->precio }}" class="form-control">

                    <div class="row">
                        <div class="col-md-6">
                            <label for="cant">Cantidad</label>
                            <input type="number" id="cant" name="cantidad" value="{{ $producto->cantidad }}" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="cat">Categoria</label>
                            <select name="categoria_id" id="cat" class="form-control" required>
                                <option value="">Seleccione una opcion</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{$categoria->id}}" {{($categoria->id == $producto->categoria_id)?'selected':''}} >{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <label for="desc">Descripcion</label>
                            <textarea name="descripcion" id="desc" cols="10" rows="5" class="form-control">{{ $producto->descripcion }}</textarea>
                        </div>
                        <div class="col-md-4">
                            <img src="/{{ $producto->imagen }}" alt="" width="100%">
                        </div>
                    </div>

                    <label for="img">Imagen</label>
                    <input type="file" id="img" name="imagen" class="form-control">

                    <input type="submit">

                </form>

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">

            </div>
        </div>
    </div>
</div>

@endsection