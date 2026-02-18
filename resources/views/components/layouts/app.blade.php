<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Bootstrap 4 --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('dist/app.css') }}">
    {{-- Custom CSS --}}
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <title>{{ $title ?? config('app.name') }}</title>
</head>

<body>

    {{-- Navbar --}}
    @include('components.header', ['topCategories' => $topCategories ?? []])

    {{-- Main Content Area --}}
    <main class="container py-5">

        {{-- Flash Message --}}
        @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
        @endif

        {{-- Page Content --}}
        {{ $slot }}

    </main>

    <footer class="text-center py-4 text-muted small">
        © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </footer>

    {{-- Bootstrap JS --}}
    <script src="{{ asset('dist/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

</body>

</html>