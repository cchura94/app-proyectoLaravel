@extends("layouts.admin")

@section("titulo", "Lista pedidos")

@section("contenedor")

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>COD</th>
                            <th>FECHA</th>
                            <th>CLIENTE</th>
                            <th>PRODUCTOS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pedidos as $pedido)
                            <tr>
                                <td>{{ $pedido->cod_pedido }}</td>
                                <td>{{ $pedido->fecha }}</td>
                                <td>
                                    <h6>{{ $pedido->cliente->nombre_completo }}</h6>
                                    <span>{{ $pedido->cliente->correo }}</span>
                                </td>
                                <td><!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal{{$pedido->id}}">
  ver Productos
</button>

<!-- Modal -->
<div class="modal fade" id="Modal{{$pedido->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalles Productos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table id="example-table-id" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Nombre</th>
              <th>Cantidad</th>
              <th>Precio</th>
              <th>Sub Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pedido->productos as $prod)  
            <tr>
              <td>{{ $prod->id }}</td>
              <td>{{ $prod->nombre }}</td>
              <td>{{ $prod->pivot->cantidad }}</td>  
              <td>{{ $prod->precio }}</td> 
              <td>{{ $prod->precio * $prod->pivot->cantidad }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

@endsection