<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/users.css'])
    <title>Document</title>
</head>
<header class="header">
    <h1>APP</h1>
    <nav>
        <ul>
            <li>¿Aún no estás registrado? Crea tu cuenta y disfruta de App</li>
            <li><a href="{{ route('users.showRegister') }}">Registrarse</a></li>
        </ul>
    </nav>
</header>
<body>
    <form class="formLogin" action="{{ route('users.doLogin') }}" method="post">
        <h1>LOGIN</h1>
        @csrf
        <label for="email">Email</label>
        <input type="email" name="email" id="email"><br>
        @error("email") <small>{{ $message }}</small> @enderror
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password">
        @error("password") <small>{{ $message }}</small> @enderror
        <br>
        <br>
        <button class="btnAceptar" type="submit" value="Login">Login</button>
        <br>
        <button class="btnCancelar" type="reset" value="Cancelar">Cancelar</button>
    </form>
</body>
</html>