<x-layouts.app title="Create Category">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="mb-4">Add New Category</h2>

            <form action="{{ route('admin.category.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" placeholder="Enter category name">

                    @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Create Category</button>
                <a href="{{ route('admin.category') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</x-layouts.app>