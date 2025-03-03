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
            <li><a href="{{ route('posts.insert') }}">Añadir post</a></li>
            <li><a href="{{ route('logout') }}">Cerrar sesión</a></li>
            <li><a href="{{ route('confirmDelete') }}">Eliminar mi cuenta</a></li>
        </ul>
    </nav>
</header>
<body>
    <div class="container">
        <h1 class="main">Todos los Posts</h1>

        {{-- Asegurarse que $posts está definido --}}
        @if (isset($posts) && $posts->isNotEmpty())
            @foreach ($posts as $post)
                <div class="post-card">
                    <div class="post-header">
                        <p><strong>Publicado por:</strong> {{ $post->user->name }}</p>
                        <h3>{{ $post->title }}</h3>
                        <p class="post-date">{{ $post->publish_date->format('d M Y H:i') }}</p>
                    </div>
                    
                    <div class="post-body">
                        <p>{{ $post->description }}</p>
                        @if ($post->image)
                            <img src="{{ $post->image }}" alt="Post image" class="post-image">
                        @endif
                    </div>
                    
                    <div class="post-footer">
                        {{-- Botón de "like" con el número de likes dentro --}}
                        <form class="formBtn" action="{{ route('posts.like', ['id' => $post->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btnLike">
                            Likes: {{ $post->n_likes }}
                        </button>
                        </form>

                        {{-- Enlace para ver el post completo --}}
                        <a href="{{ route('comments.show', ['id' => $post->id]) }}" class="btnComment">Comentar</a>

                        {{-- Eliminar post solo si pertenece al usuario logueado --}}
                        @if (auth()->id() === $post->belongs_to)  {{-- Compara con 'belongs_to' --}}
                            <form action="{{ route('posts.delete', ['id' => $post->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btnEliminarPost">Eliminar</button>
                            </form>
                        @endif
                    </div>
                </div>
                <hr>
            @endforeach
        @else
            <p>No se han encontrado posts.</p>
        @endif
    </div>
</body>
<footer>
    <div class="datosHeader">
        <img src="../img/logo.png" alt="imagen logo" width="200px" height="100px">
        <h1>POSTSNAP</h1>
    </div> 
</footer>
</html>
