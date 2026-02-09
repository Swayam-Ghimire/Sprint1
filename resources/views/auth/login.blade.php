<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <title>{{ config('app.name') }}</title>
</head>

<body class="bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="card shadow-sm" style="width: 380px;">
        <div>
            @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
        </div>
        <div class="card-body p-4">
            <h4 class="text-center mb-4">Login</h4>

            <form method="POST" action="{{ route('login.store') }}">
                @csrf

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter password">
                </div>
                <x-error />
                <button type="submit" class="btn btn-primary btn-block">
                    Login
                </button>
            </form>

            <p class="text-center mt-3 mb-0">
                <small>Don’t have an account?
                    <a href="{{ url('/register') }}">Register</a>
                </small>
            </p>
        </div>
    </div>
</body>

</html>