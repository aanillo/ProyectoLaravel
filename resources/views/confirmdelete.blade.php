<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/users.css'])
    <title>Confirmar eliminación</title>
</head>
<header class="header">
    <div class="datosHeader">
        <img src="../img/logo.png" alt="imagen logo" width="100px" height="60px">
        <h1>POSTSNAP</h1>
    </div>
    <nav>
        <ul>
            <li>Volver a login:</li>
            <li><a href="{{ route('login') }}">Login</a></li>
        </ul>
    </nav>
</header>
<body>
    <form class="formEliminar" action="{{ route('deleteUser') }}" method="POST">
        @csrf
        <h1>¿Estás seguro de que deseas eliminar tu cuenta?</h1>
        <button class="btnEliminar" type="submit">Sí, eliminar mi cuenta</button>
        <br>
        <a class="volver" href="{{ route('home') }}">Cancelar</a>
    </form>
</body>
<footer>
    <div class="datosHeader">
        <img src="../img/logo.png" alt="imagen logo" width="200px" height="100px">
        <h1>POSTSNAP</h1>
    </div> 
</footer>
</html>


