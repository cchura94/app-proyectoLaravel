@extends("layouts.admin")

@section("titulo", "Lista Productos")

@section("contenedor")

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h1>Lista de Productos</h1>
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>PRECIO</th>
                            <th>CANTIDAD</th>
                            <th>CATEGORIA</th>
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
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $productos->links() }}

            </div>
        </div>

    </div>
</div>

@endsection