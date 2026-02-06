<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreateFormRequest;
use App\Http\Requests\Posts\UpdateFormRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::orderBy('published_at', 'desc')->paginate(10);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateFormRequest $request)
    {
        // /posts/create post method
        $data = $request->validated();
        if ($request->hasFile('photo')) {
            $data['path'] = $request->file('photo')->store('posts', 'public');
        } else {
            $data['path'] = null;
        }
        $post = Post::create($data);

        return redirect()->route('posts.show', $post)->with('message', 'Post created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormRequest $request, Post $post)
    {
        //
        $data = $request->validated();
        $newPost = [
            'title' => $data['title'] ?? $post->title,
            'content' => $data['content'] ?? $post->content,
            'published_at' => $data['published_at'] ?? $post->published_at,
        ];
        if ($request->hasFile('photo')) {
            $newPost['path'] = $request->file('photo')->store('posts', 'public');
            if ($post->path) {
                Storage::disk('public')->delete($post->path);
            }
        } else {
            $newPost['path'] = $post->path;
        }
        $post->update($newPost);

        return redirect()->route('posts.show', $post)->with('message', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->path) {
            Storage::disk('public')->delete($post->path);
        }
        $post->delete();

        return redirect()->route('posts.index')->with('mesasge', 'Post deleted successfully');
        // return redirect()->back()->with('mesasge', 'Post deleted successfully');
        // return redirect('/posts')
        // return redirect()->to('/posts') // helper function
    }
}
