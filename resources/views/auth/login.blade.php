<h1>Ingresar</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="/login" method="post">
    @csrf
    <label for="">Ingrese Correo</label>
    <input type="email" name="email">
    <br>
    <label for="">Ingrese su Contraseña</label>
    <input type="password" name="password">
    <br>
    <input type="submit" value="Ingresar">
</form>