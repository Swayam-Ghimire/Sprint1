<x-layouts.app>
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-body">

                <h2 class="card-title mb-2">
                    {{ $post->title }}
                </h2>

                <p class="text-muted"> {{-- Changed to text-muted for consistency --}}
                    Published By: {{ $post->user->name }}
                </p>
                <p class="text-muted"> {{-- Changed to text-muted for consistency --}}
                    Category: {{ $post->category->name }}
                </p>

                <p class="text-muted mb-4">
                    Published on {{ \Carbon\Carbon::parse($post->published_at)->format('Y-m-d') }}
                </p>

                @if ($post->images && count($post->images) > 0)
                <div class="row justify-content-center mb-4"> {{-- Use Bootstrap row/col for image layout --}}
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

                <div class="mb-4">
                    <p class="lead"> {{-- Replaced fs-5 with lead for Bootstrap 4 compatibility --}}
                        {!! $contentHtml !!}
                    </p>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex justify-content-between align-items-center mt-4"> {{-- Replaced Tailwind flex
                    utilities --}}
                    <div>
                        @can('viewEdit', $post)
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary me-2"> {{-- Added me-2 for
                            spacing --}}
                            Edit
                        </a>

                        @endcan
                        @can('viewDelete', $post)
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline"> {{--
                            Ensured form is inline --}}
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">
                                Delete
                            </button>
                        </form>
                    </div>
                    @endcan
                    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary ml-auto">
                        All Posts
                    </a>
                    @can('isAdmin')
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary ml-2">
                        Dashboard
                    </a>
                    @endcan
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>