<x-layouts.app>
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-body">

                <h2 class="card-title mb-2">
                    {{ $post->title }}
                </h2>

                <p class="text-active">
                    Published By: {{ $post->user->name }}
                </p>

                <p class="text-muted mb-4">
                    Published on {{ \Carbon\Carbon::parse($post->published_at)->format('Y-m-d') }}
                </p>

                @if (!empty($post->path))
                @foreach ($post->path as $image)
                <div class="text-center mb-4">
                    <img src="{{ asset('storage/' . $image) }}" class="img-thumbnail rounded-circle"
                        style="width:120px; height:120px; object-fit:cover;">
                </div>
                @endforeach
                @else
                <div class="alert alert-secondary text-center">
                    No image found
                </div>
                @endif

                <div class="mb-4">
                    <p class="fs-5">
                        {{ $post->content }}
                    </p>
                </div>
                @can('view', $post)
                <div class="d-flex gap-2">
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">
                        Edit
                    </a>

                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">
                            Delete
                        </button>
                    </form>

                    @endcan
                    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary ms-auto">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>