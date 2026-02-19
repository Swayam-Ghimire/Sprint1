<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreateFormRequest;
use App\Http\Requests\Posts\UpdateFormRequest;
use App\Models\Category;
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
        $posts = Post::orderBy('published_at')->paginate(10);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();

        return view('posts.create', compact('categories'));
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
        // $data['path'] = $paths;
        $post = Auth::user()->posts()->create($data);
        foreach ($paths as $path) {
            $post->images()->create(['path' => $path]);
        }

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

        $categories = Category::all();

        return view('posts.edit', compact('post', 'categories'));
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
            'category_id' => $data['category_id'] ?? $post->category_id,
            'published_at' => $data['published_at'] ?? $post->published_at,
        ];

        $post->update($newPost);
        if ($request->hasFile('photo')) {
            $paths = [];
            foreach ($request->file('photo') as $image) {
                $paths[] = $image->store('posts', 'public');
            }
            // $newPost['path'] = $paths;
            // if ($post->images->isNotEmpty()) {
            //     foreach ($post->images as $image) {
            //         Storage::disk('public')->delete($image->path);
            //     }
            //     $post->images()->delete();

            // }
            // delete image
            Post::deleteImage($post);

            // create new image record
            foreach ($paths as $path) {
                $post->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('posts.show', $post)->with('message', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);
        // if ($post->images->isNotEmpty()) {
        //     foreach ($post->images as $image) {
        //         Storage::disk('public')->delete($image->path);
        //     }
        //     $post->images()->delete();
        // }
        Post::deleteImage($post);
        $post->delete();

        return redirect()->route('posts.index')->with('message', 'Post deleted successfully');
        // return redirect()->back()->with('mesasge', 'Post deleted successfully');
        // return redirect('/posts')
        // return redirect()->to('/posts') // helper function
    }
}
