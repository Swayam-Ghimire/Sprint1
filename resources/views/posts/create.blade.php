<x-layouts.app>
    <h1>Create New Post</h1>
    @if($errors->any())
    <div class="alert alert-danger mt-2">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title">
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" name="content" id="content" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="published_at" class="form-control-file" id="date">
        </div>


        <div class="form-group">
            <label for="photo">Photo</label>
            <input type="file" name="photo" class="form-control-file" id="photo">
        </div>

        <button type="submit" class="btn btn-primary">
            Create Post
        </button>
    </form>
</x-layouts.app>