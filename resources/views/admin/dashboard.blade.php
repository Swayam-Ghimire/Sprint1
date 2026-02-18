<x-layouts.app title="Admin Dashboard">

    <div class="container py-4">

        {{-- Page Header --}}
        <div class="mb-4">
            <h2 class="font-weight-bold">Admin Dashboard</h2>
            <p class="text-muted mb-0">
                Welcome to the admin dashboard! Manage users, posts, categories, and roles.
            </p>
        </div>

        {{-- Stats Cards --}}
        <div class="row">

            {{-- Users Card --}}
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card text-white bg-primary h-100 shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-uppercase">Users</h6>
                        <h3 class="font-weight-bold">120</h3>
                        <p class="mb-0 small">Total registered users</p>
                    </div>
                </div>
            </div>

            {{-- Posts Card --}}
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card text-white bg-success h-100 shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-uppercase">Posts</h6>
                        <h3 class="font-weight-bold">340</h3>
                        <p class="mb-0 small">Total published posts</p>
                    </div>
                </div>
            </div>

            {{-- Categories Card --}}
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card text-white bg-warning h-100 shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-uppercase">Categories</h6>
                        <h3 class="font-weight-bold">15</h3>
                        <p class="mb-0 small">Available categories</p>
                    </div>
                </div>
            </div>

            {{-- Roles Card --}}
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card text-white bg-danger h-100 shadow-sm border-0">
                    <div class="card-body">
                        <h6 class="text-uppercase">Roles</h6>
                        <h3 class="font-weight-bold">4</h3>
                        <p class="mb-0 small">System roles</p>
                    </div>
                </div>
            </div>

        </div>

    </div>

</x-layouts.app>
