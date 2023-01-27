@extends("layouts.admin")

@section("titulo", "Nuevo Usuario")

@section("contenedor")

<form action="{{ route('usuario.create') }}" method="post">
    @csrf
    <div class="row">

        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h1>Nuevo Usuario</h1>
                    <label for="">Ingrese Nombre</label>
                    <input type="text" name="name" class="form-control">

                    <label for="">Ingrese Correo</label>
                    <input type="email" name="email" class="form-control">

                    <label for="">Ingrese Contraseña</label>
                    <input type="password" name="password" class="form-control">

                    <label for="">repita su Contraseña</label>
                    <input type="password" name="c_password" class="form-control">

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <input type="submit" class="btn btn-primary btn-block" value="Guardar Usuario">
                </div>
            </div>
        </div>
    </div>
</form>

@endsection