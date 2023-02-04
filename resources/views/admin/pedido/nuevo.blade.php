@extends("layouts.admin")

@section("titulo", "Nuevo pedido")

@section("contenedor")

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Cliente</h5>
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
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label for="">Nombre Cliente</label>
        <input type="text" id="clie_nombre_completo" class="form-control">
        <label for="">Correo</label>
        <input type="email" id="clie_correo" class="form-control">
        <label for="">Telefono</label>
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
                <h5>Seleccion de Producto</h5>
                <div class="row">

                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="">Seleccionar Producto</label>
                                <select id="select_clie_id" class="form-control">
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Precio</label>
                                <input type="number" id="input_precio" step="0.01" class="form-control" readonly>
                            
                            </div>
                            <div class="col-md-2">
                                <label for="">Asignar Cantidad</label>
                                <input type="number" id="input_cantidad" class="form-control" value="1" min="1" max="100">
                            </div>
                            <div class="col-md-2">
                                <label for="">Asignar al Pedido</label>
                                <button class="btn btn-info btn-block" onclick="addProducto()">Agregar</button>
                            </div>
                        </div>
                    </div>

                </div>                
            </div>
        </div>        
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>Lisa de Producto (CARRITO)</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>NOMBRE</th>
                            <th>PRECIO</th>
                            <th>CANTIDAD</th>
                            <th>ST</th>
                            <th>ACCION</th>
                        </tr>
                    </thead>
                    <tbody id="carrito"></tbody>
                </table>

                <button type="button" onclick="enviarPedidoBD()">Guardar Pedido</button>
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
    let productos = [];
    let producto_seleccionado = null;
    let carrito = [];


    getProductos();

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
                        <label>Nombre CLiente</label>
                        <input type="text" class="form-control" value="${cliente.nombre_completo}" readonly>
                        </div>
                        <div class="col-md-4">
                        <label>Telefono</label>
                        <input type="text" class="form-control" value="${cliente.telefono}" readonly>
                        </div>
                        <div class="col-md-4">
                        <label>Correo</label>
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

    async function getProductos() {
        const {data} = await axios.get('/admin/producto/listar_axios');
        productos = data;

        cargarDatosAlSelect()
        
    }

    function cargarDatosAlSelect() {
        opciones = `<option value="">Seleccione producto</option>`;
        productos.forEach(prod => {
            opciones += `<option value="${prod.id}">${prod.nombre}</option>`;
        });

        document.getElementById("select_clie_id").innerHTML = opciones;
    }


    document.getElementById("select_clie_id").onchange = function() {
        let prod_select = this.value;
        producto_seleccionado = productos.find(option => option.id == prod_select);
        console.log(producto_seleccionado);
        document.getElementById("input_precio").value = producto_seleccionado.precio
    };

    function addProducto() {
        
        let cantidad = document.getElementById("input_cantidad").value
        let prod = {
            id: producto_seleccionado.id,
            nombre: producto_seleccionado.nombre,
            precio: producto_seleccionado.precio,
            cantidad: cantidad
        }

        carrito.push(prod)

        console.log(carrito);

        actualizarCarrito();
    }    

    function actualizarCarrito() {
        let html_table = "";
        carrito.forEach(prod => {
            html_table += `
                <tr>
                    <td>${prod.nombre}</td>
                    <td>${prod.precio}</td>
                    <td>${prod.cantidad}</td>
                    <td>${prod.cantidad * prod.precio }</td>
                    <td>
                        <button class="btn btn-danger" onclick="quitarProducto(${prod.id})">X</button>
                    </td>
                </tr>
            `;
        });

        document.getElementById("carrito").innerHTML = html_table;
    }

    function quitarProducto(id_prod) {
        carrito.forEach(prod_c => {
            if (prod_c.id == id_prod) {
                carrito.splice(carrito.indexOf(prod_c), 1);
            }
        })
        
        actualizarCarrito();
    }

    async function enviarPedidoBD() {

        let datos = {
            cliente_id: cliente.id,
            carrito: carrito
        }

        await axios.post('/admin/pedido', datos)     
        
        Swal.fire({
                        title: 'Pedido Registrado!',
                        text: 'Pedido registrado',
                        icon: 'info',
                        confirmButtonText: 'OK'
                    })
    }
    
    
</script>
@endsection