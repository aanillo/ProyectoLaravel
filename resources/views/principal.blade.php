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
            <li><a>Ver todos mis posts</a></li>
            <li><a>Eliminar mi cuenta</a></li>
        </ul>
    </nav>
</header>
<body>
    <div class="container">
        <h1>Todos los Posts</h1>

        {{-- Asegurar que $posts está definido --}}
        @if (isset($posts) && $posts->isNotEmpty())
            @foreach ($posts as $p)
                <div class="post-card">
                    <div class="post-header">
                        <h3>{{ $p->title }}</h3>
                        <p class="post-date">{{ $p->publish_date->format('d M Y H:i') }}</p>
                    </div>
                    
                    <div class="post-body">
                        <p>{{ $p->description }}</p>
                        @if ($p->image)
                            <img src="{{ $p->image }}" alt="Post image" class="post-image">
                        @endif
                    </div>
                    
                    <div class="post-footer">
                        <span class="likes-count">{{ $p->n_likes }} Likes</span>
    

                        {{-- Enlace para ver el post completo --}}
                        <a href="{{ route('posts.show', ['id' => $p->id]) }}" class="btn btn-primary">Ver Post</a>

                        {{-- Eliminar post solo si pertenece al usuario logueado --}}
                        @if (auth()->id() === $p->belongs_to)
                            <form action="{{ route('posts.delete', ['id' => $p->id]) }}" method="POST" style="display:inline;">
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
</body>

</html>
