<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreateFormRequest;
use App\Http\Requests\Posts\UpdateFormRequest;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    use AuthorizesRequests;

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
        $paths = [];
        if ($request->hasFile('photo')) {
            foreach ($request->file('photo') as $image) {
                $paths[] = $image->store('posts', 'public');
            }
        }
        $data['path'] = $paths;
        $post = Auth::user()->posts()->create($data);

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
        Gate::authorize('view', $post);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFormRequest $request, Post $post)
    {
        //
        Gate::authorize('update', $post);

        $data = $request->validated();
        $newPost = [
            'title' => $data['title'] ?? $post->title,
            'content' => $data['content'] ?? $post->content,
            'published_at' => $data['published_at'] ?? $post->published_at,
        ];

        if ($request->hasFile('photo')) {
            $paths = [];
            foreach ($request->file('photo') as $image) {
                $paths[] = $image->store('posts', 'public');
            }
            $newPost['path'] = $paths;
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
        Gate::authorize('destroy', $post);
        if (! empty($post->path)) {
            foreach ($post->path as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $post->delete();

        return redirect()->route('posts.index')->with('message', 'Post deleted successfully');
        // return redirect()->back()->with('mesasge', 'Post deleted successfully');
        // return redirect('/posts')
        // return redirect()->to('/posts') // helper function
    }
}
