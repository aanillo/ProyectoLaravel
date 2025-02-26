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
            <li><a href="{{ route('posts.insert') }}">Añadir post</a></li>
            <li><a href="{{ route('logout') }}">Cerrar sesión</a></li>
            <li><a>Eliminar mi cuenta</a></li>
        </ul>
    </nav>
</header>
<body>
    <div class="container">
        <h1>Todos los Posts</h1>

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
                        <button class="btn btn-success" id="like-button-{{ $post->id }}" onclick="incrementLikes({{ $post->id }})">
                            Likes: <span id="like-count-{{ $post->id }}">{{ $post->n_likes }}</span>
                        </button>

                        {{-- Enlace para ver el post completo --}}
                        <a href="{{ route('comments.show', ['id' => $post->id]) }}" class="btn btn-primary">Comentar</a>

                        {{-- Eliminar post solo si pertenece al usuario logueado --}}
                        @if (auth()->id() === $post->user_id)
                            <form action="{{ route('posts.delete', ['id' => $post->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
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
    <script>
        // Función para incrementar los likes al hacer clic en el botón
        function incrementLikes(postId) {
            // Obtén el elemento del contador de likes
            const likeCountElement = document.getElementById('like-count-' + postId);
            
            // Obtén el valor actual de likes y conviértelo en un número
            let currentLikes = parseInt(likeCountElement.textContent);
            
            // Incrementa el número de likes
            currentLikes += 1;
            
            // Actualiza el texto del contador de likes
            likeCountElement.textContent = currentLikes;
        }
    </script>
</body>
</html>
