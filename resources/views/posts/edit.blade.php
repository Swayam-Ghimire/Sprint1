<x-layouts.app>
    <h1>Edit Posts</h1>
    <x-error />
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

        <div class="form-group">
            <label for="category_id">Category</label>

            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                <option value="">-- Select Category --</option>

                @foreach($categories as $category)
                <option value={{ $category->id }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Photo</label>
            <input type="file" name="photo[]" multiple class="form-control">

            @if ($post->images)
            @foreach ($post->images as $image)
            <div class="text-center mb-4">
                <img src="{{ asset('storage/' . $image->path) }}" class="img-thumbnail rounded-circle"
                    style="width:120px; height:120px; object-fit:cover;">
            </div>
            @endforeach
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</x-layouts.app>