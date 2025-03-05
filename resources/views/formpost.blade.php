<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/users.css'])
    <title>Página principal</title>
</head>
<header class="header">
    <div class="datosHeader">
        <img src="../img/logo.png" alt="imagen logo" width="100px" height="60px">
        <h1>POSTSNAP</h1>
    </div>
    <nav>
        <ul>
            <li><a href="{{ route('home') }}">Inicio</a></li>
            <li><a href="{{ route('logout') }}">Cerrar sesión</a></li>
            <li><a href="{{ route('confirmDelete') }}">Eliminar mi cuenta</a></li>
        </ul>
    </nav>
</header>
<body>


<form class="formPost" action="{{ route('posts.store') }}" method="POST">
    <h1>INSERTAR POST</h1>
    @csrf
    <label for="title">Título:</label>
    <input type="text" name="title" id="title" required>
    @error("title") <small>{{ $message }}</small> @enderror
    <br>
    <label for="description">Descripción:</label>
    <input type="text" name="description" id="descritcion" required>
    @error("description") <small>{{ $message }}</small> @enderror
    <br>
    <label for="image">URL de la imagen:</label>
    <input type="text" name="image" id="image" placeholder="https://example.com/imagen.jpg">
    @error("image") <small>{{ $message }}</small> @enderror
    <br>
    <br>
    <button class="btnAceptar" type="submit">Agregar post</button>
    <br>
    <button class="btnCancelar" type="reset">Cancelar</button>
</form>

</body>
<footer>
    <div class="datosHeader">
        <img src="../img/logo.png" alt="imagen logo" width="200px" height="100px">
        <h1>POSTSNAP</h1>
    </div> 
</footer>

</html>
