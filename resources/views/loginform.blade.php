<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/users.css'])
    <title>Document</title>
</head>
<body>
    <form action="{{ route('users.doLogin') }}" method="post">
        <h1>REGISTRO DE USUARIO</h1>
        @csrf
        <label for="email">Email</label>
        <input type="email" name="email" id="email"><br>
        @error("email") <small>{{ $message }}</small> @enderror
        <br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password">
        @error("password") <small>{{ $message }}</small> @enderror
        <br>
        <button type="submit" value="Login">Login</button>
        <button type="reset" value="Cancelar">Cancelar</button>
    </form>
</body>
</html>