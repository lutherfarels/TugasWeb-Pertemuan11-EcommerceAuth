<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    use AuthorizesRequests;

    /**
     * Menampilkan semua post.
     */
    public function index()
    {
        $posts = Post::with('user')
            ->latest()
            ->get();

        return view('posts.index', compact('posts'));
    }

    /**
     * Menampilkan form untuk membuat post baru.
     */
    public function create()
    {
        $this->authorize('create', Post::class);

        return view('posts.create');
    }

    /**
     * Menyimpan post baru.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $validated['user_id'] = auth()->id();

        Post::create($validated);

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post berhasil dibuat.');
    }

    /**
     * Menampilkan satu post.
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);

        $post->load('user');

        return view('posts.show', compact('post'));
    }

    /**
     * Menampilkan form edit post.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    /**
     * Memperbarui post.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update($validated);

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post berhasil diperbarui.');
    }

    /**
     * Menghapus post.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post berhasil dihapus.');
    }
}