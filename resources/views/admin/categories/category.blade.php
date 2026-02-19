<x-layouts.app title="Category Management">
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Category Management</h2>
                <a href="{{ route('admin.category.create') }}" class="btn btn-primary">
                    Add Category
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="font-weight-bold">{{ $category->name }}</td>

                            {{-- Actions --}}
                            <td class="text-center">
                                <a href="{{ route('admin.category.edit', $category->id) }}"
                                    class="btn btn-sm btn-outline-primary">
                                    Edit
                                </a>

                                <form action="{{ route('admin.category.delete', $category->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
</x-layouts.app>
