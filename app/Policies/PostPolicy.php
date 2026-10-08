<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * Admin dan editor boleh melihat post.
     */
    public function view(User $user, Post $post): bool
    {
        return in_array($user->role, ['admin', 'editor']);
    }

    /**
     * Admin dan editor boleh membuat post.
     */
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'editor']);
    }

    /**
     * Admin dan editor boleh mengedit post.
     */
    public function update(User $user, Post $post): bool
    {
        return in_array($user->role, ['admin', 'editor']);
    }

    /**
     * Admin dan editor boleh menghapus post.
     */
    public function delete(User $user, Post $post): bool
    {
        return in_array($user->role, ['admin', 'editor']);
    }
}