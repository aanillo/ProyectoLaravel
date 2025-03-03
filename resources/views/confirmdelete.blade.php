<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/users.css'])
    <title>Confirmar eliminación</title>
</head>
<header class="header">
    <h1>APP</h1>
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
</html>


