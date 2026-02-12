<x-layouts.app>

    <h2 class="mb-4">Create New Post</h2>

    {{-- Error Messages --}}
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Title --}}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Content --}}
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" rows="4"
                        class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                    @error('content')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- Published Date --}}
                <div class="form-group">
                    <label for="date">Published Date</label>
                    <input type="date" name="published_at" id="date" value="{{ old('published_at') }}"
                        class="form-control @error('published_at') is-invalid @enderror">
                    @error('published_at')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                {{-- Category --}}
                <div class="form-group">
                    <label for="category_id">Category</label>

                    <select name="category_id" id="category_id"
                        class="form-control @error('category_id') is-invalid @enderror">
                        <option value="" disabled>-- Select Category --</option>

                        @foreach($categories as $category)
                        <option value={{ $category->id }}>
                            {{ $category->name }}
                        </option>

                        @endforeach
                    </select>
                </div>
                {{-- Photos --}}
                <div class="form-group">
                    <label for="photo">Upload Photos</label>
                    <input type="file" name="photo[]" id="photo" multiple class="form-control">
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn btn-primary btn-block">
                    Create Post
                </button>

            </form>

        </div>
    </div>


</x-layouts.app>