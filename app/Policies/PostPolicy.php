<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class PostPolicy
{
    public function view(User $user, Post $post): bool
    {
        return $user->id === $post->user_id || Gate::allows('isEditor') || Gate::allows('isAdmin');
    }

    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id || Gate::allows('isEditor') || Gate::allows('isAdmin');
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id || Gate::allows('isEditor') || Gate::allows('isAdmin');
    }
}
