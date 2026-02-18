<x-layouts.app :topCategories="$topCategories" title="Create Post">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="mb-4">Create New Post</h2>

            {{-- Error Messages --}}
            <x-error />

            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Title --}}
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                        class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Content --}}
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea name="content" id="content" rows="5"
                        class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                    @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Published Date --}}
                <div class="form-group">
                    <label for="published_at">Published Date</label>
                    <input type="date" name="published_at" id="published_at" value="{{ old('published_at') }}"
                        class="form-control @error('published_at') is-invalid @enderror">
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
                        <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Photos --}}
                <div class="form-group">
                    <label for="photo">Upload Photos</label>
                    <input type="file" name="photo[]" id="photo" multiple class="form-control-file"
                        style="display: block; width: 100%; padding: 8px 12px; border: 1px solid #ced4da; border-radius: 6px; background-color: #fff; cursor: pointer;">
                    @error('photo.*')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>





                {{-- Submit --}}
                <button type="submit" class="btn btn-primary btn-block">Create Post</button>
            </form>
        </div>
    </div>
</x-layouts.app>