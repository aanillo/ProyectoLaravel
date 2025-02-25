<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/users.css'])
    <title>All Posts</title>
</head>
<body>
    <div class="container">
        <h1>All Posts</h1>
        
        
        @foreach($posts as $post)
            <div class="post-card">
                <div class="post-header">
                    <h2><a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a></h2>
                    <p class="publish-date">Published on: {{ \Carbon\Carbon::parse($post->publish_date)->format('M d, Y') }}</p>
                </div>
                
                <div class="post-content">
                  
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post image" class="post-image">
                    @endif
                    
                    <p class="post-description">{{ $post->description }}</p>
                </div>
                
                <div class="post-footer">
                    <p>Likes: {{ $post->n_likes }}</p>
                    <p>Comments: {{ $post->comments->count() }}</p> 
                    
                   
                    @if($post->belongs_to == auth()->user()->id)
                        <form action="{{ route('post.destroy', $post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button">Delete Post</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach

        
        <div class="create-post">
            <h2>Create a New Post</h2>
            <form action="{{ route('post.store') }}" method="POST">
                @csrf
                <label for="title">Title</label>
                <input type="text" name="title" id="title" required>

                <label for="description">Description</label>
                <textarea name="description" id="description" required></textarea>

                <label for="image">Image (optional)</label>
                <input type="file" name="image" id="image">

                <button type="submit" class="create-button">Create Post</button>
            </form>
        </div>
    </div>
</body>
</html>
