<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/users.css'])
    <title>Página principal</title>
</head>
<header class="header">
    <h1>APP</h1>
    <nav>
        <ul>
            <li><a>Volver a HOME</a></li>
            <li><a>Ver todos mis posts</a></li>
            <li><a>Eliminar mi cuenta</a></li>
        </ul>
    </nav>
</header>
<body>
<h1>INSERTAR POST</h1>

<form action="{{ route('posts.store') }}" method="POST">
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
    <button type="submit">Agregar tarea</button>
    <button type="reset">Cancelar</button>
</form>

</body>

</html>
