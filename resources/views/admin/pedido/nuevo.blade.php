@extends("layouts.admin")

@section("titulo", "Nuevo pedido")

@section("contenedor")

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="cliente_id">
                            </div>
                            <div class="col-md-4">
                                <button class="btn btn-success btn-block" onclick="buscarCliente()">buscar</button> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
Nuevo Cliente
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="text" id="clie_nombre_completo" class="form-control">
        <input type="text" id="clie_correo" class="form-control">
        <input type="text" id="clie_telefono" class="form-control">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="guardarCliente()">Guardar Cliente</button>
      </div>
    </div>
  </div>
</div>

                    </div>
                    <div class="col-md-12" id="cliente_html">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                
            </div>
        </div>        
    </div>


</div>


@endsection


@section("scripts")
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    let cliente = null;

    function buscarCliente() {

        var valor_buscar = document.getElementById('cliente_id').value

        axios.get('/admin/cliente/buscar?buscar='+valor_buscar)
                .then(function (response) {
                    // handle success
                    let {data} = response

                    console.log(data);
                    cliente = data
                    document.getElementById("cliente_html").innerHTML = `
                    <div class="row">
                        <div class="col-md-4">
                        <input type="text" class="form-control" value="${cliente.nombre_completo}" readonly>
                        </div>
                        <div class="col-md-4">
                        <input type="text" class="form-control" value="${cliente.telefono}" readonly>
                        </div>
                        <div class="col-md-4">
                        <input type="text" class="form-control" value="${cliente.correo}" readonly>
                        </div>
                    </div>
                    `;

                })
                .catch(function (error) {
                    // handle error
                    Swal.fire({
                        title: 'Error!',
                        text: 'Cliente no encontrado',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    })
                    console.log(error);
                    cliente = null;
                    document.getElementById("cliente_html").innerHTML = `<h1>Cliente No encontrado.</h1>`;
                })
    }

    async function guardarCliente() {
        var clie_nom_compl = document.getElementById('clie_nombre_completo').value;
        var clie_telefono = document.getElementById('clie_telefono').value;
        var clie_correo = document.getElementById('clie_correo').value;

        const {data} = await axios.post('/admin/cliente/guardar_axios', {
                                                        nombre_completo: clie_nom_compl,
                                                        telefono: clie_telefono,
                                                        correo: clie_correo
                                                    });
                                                    console.log(data);
                    cliente = data
                    document.getElementById("cliente_html").innerHTML = `
                    <div class="row">
                        <div class="col-md-4">
                        <input type="text" class="form-control" value="${cliente.nombre_completo}" readonly>
                        </div>
                        <div class="col-md-4">
                        <input type="text" class="form-control" value="${cliente.telefono}" readonly>
                        </div>
                        <div class="col-md-4">
                        <input type="text" class="form-control" value="${cliente.correo}" readonly>
                        </div>
                    </div>
                    `;

    }
    
</script>
@endsection