<x-layouts.app title="Login">
    <div class="d-flex align-items-center justify-content-center" style="min-height: 80vh;">
        <div class="card shadow-sm" style="width: 380px;">

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
                    <small>
                        Don’t have an account?
                        <a href="{{ url('/register') }}">Register</a>
                    </small>
                </p>
            </div>
        </div>
    </div>

</x-layouts.app>