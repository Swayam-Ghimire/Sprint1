<nav class="navbar navbar-light bg-light px-4 custom-navbar">
    <div class="ml-auto">
        <ul class="navbar-nav flex-row align-items-center">

            @guest
            <li class="nav-item custom-dropdown">
                <button class="nav-link custom-dropdown-toggle" type="button" aria-expanded="false">
                    Actions
                </button>

                <div class="custom-dropdown-menu">
                    <a class="dropdown-item" href="{{ url('/login') }}">Login</a>
                    <a class="dropdown-item" href="{{ url('/register') }}">Register</a>
                </div>
            </li>
            @endguest

            @auth
            <li class="nav-item custom-dropdown">
                <button class="nav-link custom-dropdown-toggle d-flex align-items-center p-0" type="button"
                    aria-expanded="false">
                    @if(auth()->user()->image)
                    {{--
            <li class="nav-item"> --}}
                <img src="{{ asset('storage/' . auth()->user()->image->path) }}" alt="Profile Picture"
                    class="rounded-circle" width="40" height="40"
                    style="object-fit: cover;transition:all 0.2s ease;border:2px solid #e5e7eb;border-radius:50%;">
                {{--
            </li> --}}
            @else
            {{-- <li class="nav-item"> --}}
                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=000000&background=ffffff"
                    width="40" height="40" alt="Profile photo" class="rounded-circle">
                {{--
            </li> --}}
            @endif
            </button>

            <div class="custom-dropdown-menu">
                <a class="dropdown-item" href="{{ route('posts.index') }}">All Posts</a>
                <a class="dropdown-item" href="{{ route('posts.create') }}">Create Post</a>

                <div class="dropdown-divider"></div>

                <form action="{{ route('logout') }}" method="POST" class="px-3">
                    @csrf
                    <button class="btn btn-sm btn-outline-danger btn-block">
                        Logout
                    </button>
                </form>
            </div>
            </li>

            @endauth
        </ul>
    </div>
    @auth
    <div class="ml-4">
        <ul class="navbar-nav flex-row align-items-center">
            <li class="nav-item custom-dropdown">
                <button class="nav-link custom-dropdown-toggle" type="button">
                    Top Categories
                </button>

                <div class="custom-dropdown-menu">
                    @foreach($topCategories as $category)
                    <a class="dropdown-item" href="#">
                        {{ $category->name }}
                    </a>
                    @endforeach
                </div>
            </li>
        </ul>
    </div>
    @endauth
</nav>