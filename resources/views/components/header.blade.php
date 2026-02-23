<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">

    <a class="navbar-brand font-weight-bold" href="{{ route('posts.index') }}">
        {{ config('app.name') }}
    </a>

    <div class="ml-auto d-flex align-items-center">

        @guest
        <a href="{{ url('/login') }}" class="nav-link text-white">Login</a>
        <a href="{{ url('/register') }}" class="nav-link text-white ml-3">Register</a>
        @endguest

        @auth

        {{-- Categories Dropdown --}}
        <div class="dropdown mr-3">
            <button class="btn btn-light btn-sm dropdown-toggle" type="button" id="categoriesDropdown"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Top Categories
            </button>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="categoriesDropdown">

                @foreach($topCategories as $category)
                <a class="dropdown-item" href="#">
                    {{ $category->name }}
                </a>
                @endforeach
            </div>
        </div>

        {{-- Notifications --}}
        <div class="dropdown mr-3">
            <button class="btn btn-light btn-sm position-relative" type="button" id="notificationDropdown"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell"></i>
                @if(auth()->user()->unreadNotifications->count())
                <span class="badge badge-danger position-absolute" style="top: -5px; right: -5px; font-size: 10px;">
                    {{ auth()->user()->unreadNotifications->count() }}
                </span>
                @endif
            </button>

            <div class="dropdown-menu notification-dropdown" aria-labelledby="notificationDropdown">
                <div class="notification-header d-flex justify-content-between align-items-center">
                    <span class="font-weight-bold">Notifications</span>
                    @if(auth()->user()->unreadNotifications->count())
                    <span class="badge badge-primary badge-pill small">{{ auth()->user()->unreadNotifications->count()
                        }} New</span>
                    @endif
                </div>

                <div class="notification-scroll">
                    @forelse(auth()->user()->unreadNotifications as $notification)
                    <a href="{{ route('notification.read', $notification->id) }}" class="notification-item">
                        <div class="notification-content">
                            <div class="notification-text">{{ $notification->data['message'] ?? 'New notification' }}
                            </div>
                            <div class="notification-time">{{ $notification->created_at->diffForHumans() }}</div>
                        </div>
                    </a>
                    @empty
                    <div class="p-4 text-center text-muted">
                        <span class="small">No new notifications</span>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- User Dropdown --}}
        <div class="dropdown">
            <button class="btn btn-light btn-sm dropdown-toggle d-flex align-items-center" type="button"
                id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                @if(auth()->user()->image)
                <img src="{{ asset('storage/' . auth()->user()->image->path) }}" class="profile-avatar mr-2">
                @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}"
                    class="profile-avatar mr-2">
                @endif

                {{ auth()->user()->name }}
            </button>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                @can('isAdmin')
                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                    Dashboard
                </a>
                @endcan


                <a class="dropdown-item" href="{{ route('posts.index') }}">
                    All Posts
                </a>

                <a class="dropdown-item" href="{{ route('posts.create') }}">
                    Create Post
                </a>

                {{-- <a class="dropdown-item" href="{{ route('trashed.post') }}">
                    Trashed Posts
                </a> --}}

                <div class="dropdown-divider"></div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item text-danger">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        @endauth

    </div>
</nav>