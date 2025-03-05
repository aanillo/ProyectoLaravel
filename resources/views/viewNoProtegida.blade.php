<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/users.css'])
    <title>Document</title>
</head>
<body>
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
    <form class="formLogin">
        <h1>RUTA NO PROTEGIDA</h1>
        <h2>Lo sentimos, pero estás intentando acceder a una ruta no protegida</h2>
        <br>
        <p>Puedes volver a loguearte:</p>
        <button class="btnAceptar" type="button" onclick="window.location.href='{{ route('login') }}'">Volver a login</button>
        <button></button>
    </form>
</body>
<footer>
    <div class="datosHeader">
        <img src="../img/logo.png" alt="imagen logo" width="200px" height="100px">
        <h1>POSTSNAP</h1>
    </div> 
</footer>
</html>