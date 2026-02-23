<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class PostPolicy
{
    public function viewEdit(User $user, Post $post): bool
    {
        return $user->id === $post->user_id || Gate::allows('isEditor');
    }

    public function viewDelete(User $user, Post $post)
    {
        return $user->id === $post->user_id || Gate::allows('isAdmin');
    }

    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id || Gate::allows('isEditor');
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id || Gate::allows('isAdmin');
    }
}
