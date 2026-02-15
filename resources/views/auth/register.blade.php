<x-layouts.app title="Register">

    <div class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="card shadow-sm" style="width: 420px;">
            <div class="card-body p-4">

                <h4 class="text-center mb-4">Register</h4>

                <form method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter your name">
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter email">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password">
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control"
                            placeholder="Confirm password">
                    </div>
                    <div class="form-group">
                        <label>Profile Picture</label>
                        <input type="file" name="profile_picture" class="form-control-file">
                    </div>

                    <x-error />

                    <button type="submit" class="btn btn-primary btn-block">
                        Register
                    </button>
                </form>

                <p class="text-center mt-3 mb-0">
                    <small>
                        Already have an account?
                        <a href="{{ url('/login') }}">Login</a>
                    </small>
                </p>

            </div>
        </div>
    </div>

</x-layouts.app>