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
    <form class="formRegister" action="{{ route('users.doRegister') }}" method="post">
        <h1>REGISTRO DE USUARIO</h1>
        @csrf
        <label for="name">Nombre:</label>
        <input type="text" name="name" id="name"><br>
        @error("name") <small>{{ $message }}</small> @enderror
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email"><br>
        @error("email") <small>{{ $message }}</small> @enderror
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password">
        @error("password") <small>{{ $message }}</small> @enderror
        <br>
        <label for="password_repeat">Repita su contraseña:</label>
        <input type="password" name="password_repeat" id="password_repeat">
        @error("password") <small>{{ $message }}</small> @enderror
        <br>
        <br>
        <button class="btnAceptar" type="submit" value="Registrarse">Registrarse</button>
        <br>
        <button class="btnCancelar" type="reset" value="Cancelar">Cancelar</button>
    </form>
</body>
<footer>
    <div class="datosHeader">
        <img src="../img/logo.png" alt="imagen logo" width="200px" height="100px">
        <h1>POSTSNAP</h1>
    </div> 
</footer>
</html>