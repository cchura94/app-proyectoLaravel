<h1>Nuevo Usuario</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form action="/registro" method="post">
    @csrf
    <label for="">Ingrese Nombre</label>
    <input type="text" name="name">
    <br>
    <label for="">Ingrese Correo</label>
    <input type="email" name="email">
    <br>
    <label for="">Ingrese Contraseña</label>
    <input type="password" name="password">
    <br>
    <label for="">Repetir Contraseña</label>
    <input type="password" name="c_password">
    <br>
    <input type="submit" value="Registrarse">
</form>