<?php

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('users')->group(base_path('routes/users/user.php'));
Route::prefix('posts')->group(base_path('routes/posts/post.php'));
Route::prefix('comments')->group(base_path('routes/comments/comment.php'));
