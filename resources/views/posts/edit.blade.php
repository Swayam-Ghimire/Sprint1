<x-layouts.app title="Edit Post">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="mb-4">Edit Post</h2>

            {{-- Error Messages --}}
            <x-error />

            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Title --}}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title', $post->title) }}">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Content --}}
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" rows="5"
                        class="form-control @error('content') is-invalid @enderror">{{ old('content', $post->content) }}</textarea>
                    @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Published Date --}}
                <div class="form-group">
                    <label for="published_at">Published Date</label>
                    <input type="date" name="published_at" id="published_at"
                        class="form-control @error('published_at') is-invalid @enderror"
                        value="{{ old('published_at'), \Carbon\Carbon::parse($post->published_at)->format('Y-m-d') }}">
                    @error('published_at')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Category --}}
                <div class="form-group">
                    <label for="category_id">Category</label>
                    <select name="category_id" id="category_id"
                        class="form-control @error('category_id') is-invalid @enderror">
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ?
                            'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Upload New Photos --}}
                <div class="form-group">
                    <label for="photo">Upload New Photos</label>
                    <input type="file" name="photo[]" id="photo" multiple class="form-control-file" style="display: block; width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 6px; background-color: #fff; cursor: pointer;">
                    @error('photo.*')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Existing Photos --}}
                @if ($post->images && count($post->images) > 0)
                <div class="row justify-content-center mb-4">
                    @foreach ($post->images as $image)
                    <div class="col-auto"> {{-- Use col-auto to fit content width --}}
                        <img src="{{ asset('storage/' . $image->path) }}" class="img-thumbnail rounded-circle"
                            style="width:120px; height:120px; object-fit:cover;">
                    </div>
                    @endforeach
                </div>
                @else
                <div class="alert alert-secondary text-center">
                    No image found
                </div>
                @endif

                {{-- Actions --}}
                <button type="submit" class="btn btn-primary">Update Post</button>
                <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary ml-2">Cancel</a>
            </form>
        </div>
    </div>
</x-layouts.app>