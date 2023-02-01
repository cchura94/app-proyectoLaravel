@extends("layouts.admin")

@section("titulo", "Lista Productos")

@section("contenedor")

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <h1>Lista de Productos</h1>
                <a href="/admin/producto/create" class="btn btn-warning">Nuevo Producto</a>
                <a href="{{ url('/admin/producto/create') }}" class="btn btn-primary">Nuevo Producto</a>
                <a href="{{ route('producto.create') }}" class="btn btn-info">Nuevo Producto</a>

                <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Nuevo Producto Modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                <form action="{{route('producto.store')}}" method="post">
                    @csrf
                    <label for="nom">Nombre Producto</label>
                    <input type="text" id="nom" name="nombre" class="form-control @error('nombre') is-invalid @enderror">
                    @error('nombre')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <label for="pr">Precio</label>
                    <input type="number" step="0.01" id="pr" name="precio" class="form-control">

                    <div class="row">
                        <div class="col-md-6">
                            <label for="cant">Cantidad</label>
                            <input type="number" id="cant" name="cantidad" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="cat">Categoria</label>
                            <select name="categoria_id" id="cat" class="form-control">
                                <option value="">Seleccione una opcion</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <label for="desc">Descripcion</label>
                    <textarea name="descripcion" id="desc" cols="10" rows="2" class="form-control"></textarea>

                    <label for="img">Imagen</label>
                    <input type="file" id="img" name="imagen" class="form-control">

                    <input type="submit">

                </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>PRECIO</th>
                            <th>CANTIDAD</th>
                            <th>CATEGORIA</th>
                            <th>IMAGEN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $prod)
                            
                        <tr>
                            <td>{{ $prod->id }}</td>
                            <td>{{ $prod->nombre }}</td>
                            <td>{{ $prod->precio }}</td>
                            <td>{{ $prod->cantidad }}</td>
                            <td>{{ $prod->categoria_id }}</td>
                            <td>
                                <img src="/{{$prod->imagen}}" alt="" width="50px">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $productos->links() }}
                TOTAL DATOS: {{ $productos->total() }}

            </div>
        </div>

    </div>
</div>

@endsection