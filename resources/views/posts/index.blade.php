<x-layouts.app>
    <table class="table">
        <thead>
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
                    {{ Str::limit($post->content, 10) }}
                    <a href="{{ route('posts.show', $post->id) }}">Read more</a>
                </td>

                <td>{{ \Carbon\Carbon::parse($post->published_at)->format('Y-m-d') }}</td>

                <td>
                    @can('view', $post)
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">
                        Edit
                    </a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">
                            Delete
                        </button>
                    </form>
                    @endcan

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</x-layouts.app>