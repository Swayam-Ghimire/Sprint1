<x-layouts.app>
    <h1>Edit Posts</h1>
    @if($errors->any())
    <div class="alert alert-danger mt-2">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}">
        </div>

        <div class="mb-3">
            <label>Content</label>
            <textarea name="content" class="form-control" rows="5">{{ old('content', $post->content) }}</textarea>
        </div>

        <div class="mb-3 form-control">
            <label for="date">Date</label>
            <input type="date" name="published_at" class="form-control-file" id="date">
        </div>

        {{-- <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control">
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == old('category_id', $post->category_id) ?
                    'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div> --}}

        <div class="mb-3">
            <label>Photo</label>
            <input type="file" name="photo" class="form-control">

            @if ($post->path)
            <img src="{{ asset('storage/' . $post->path) }}" width="120" class="mt-2">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</x-layouts.app>