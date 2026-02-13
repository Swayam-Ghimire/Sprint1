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
                <button class="nav-link custom-dropdown-toggle" type="button" aria-expanded="false">
                    {{ auth()->user()->name }}
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