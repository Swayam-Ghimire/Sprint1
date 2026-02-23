<x-layouts.app title="Post Management">
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h2 class="mb-4">All Posts</h2>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Published Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $post->title }}</td>
                            <td>
                                {{ Str::limit($post->content, 20) }}
                                <a href="{{ route('posts.show', $post->id) }}">Read more</a>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($post->published_at)->format('Y-m-d') }}</td>
                            <td>
                                @can('viewEdit', $post)
                                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary mb-1">
                                    Edit
                                </a>
                                @endcan
                                @can('viewDelete', $post)
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger mb-1">Delete</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</x-layouts.app>