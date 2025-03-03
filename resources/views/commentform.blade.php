<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/users.css'])
    <title>Comentar en el Post</title>
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
            <li><a>Eliminar mi cuenta</a></li>
        </ul>
    </nav>
</header>
<body>
    <div class="container">
        <h1 class="main">Comentar en el Post: {{ $post->title }}</h1>

        <div class="post-card">
            <div class="post-header">
                <h3>{{ $post->title }}</h3>
                <p class="post-date">{{ $post->publish_date->format('d M Y H:i') }}</p>
            </div>
            
            <div class="post-body">
                <p>{{ $post->description }}</p>
                @if ($post->image)
                    <img src="{{ $post->image }}" alt="Post image" class="post-image">
                @endif
            </div>
        </div>

        <h2>Comentarios:</h2>
@if ($comments->isNotEmpty())
    @foreach ($comments as $comment)
        <div class="comment-card">
            @if ($comment->user) 
                <h4>{{ $comment->user->name }}:</h4>
            @else
                <h4>Usuario eliminado:</h4> 
            @endif
            <p>{{ $comment->comment }}</p>
            <p><small>{{ $comment->created_at->format('d M Y H:i') }}</small></p>
        </div>
        <hr>
    @endforeach
@else
    <p>No hay comentarios aún.</p>
@endif

        <form class="formcomment" action="{{ route('comments.store') }}" method="POST">
    @csrf
    <input type="hidden" name="post_id" value="{{ $post->id }}">

    <label for="comment">Comentario:</label>
    <textarea name="comment" id="comment" cols="50" rows="10" placeholder="Escribe tu comentario..."></textarea>

    @error('comment')
        <small>{{ $message }}</small>
    @enderror
    <br>
    <button type="submit" class="btnAceptar">Comentar</button>
    <br>
    <a href="{{ route('home') }}" class="btnCancelar">Cancelar</a>
</form>
    </div>
</body>
<footer>
    <div class="datosHeader">
        <img src="../img/logo.png" alt="imagen logo" width="200px" height="100px">
        <h1>POSTSNAP</h1>
    </div> 
</footer>
</html>
