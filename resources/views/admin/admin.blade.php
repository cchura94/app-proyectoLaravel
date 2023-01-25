<h1>ADMINISTRADOR</h1>

{{ Auth::user() }}

<form action="/salir" method="post">
    @csrf
    <input type="submit" value="Cerrar Sesion">
</form>