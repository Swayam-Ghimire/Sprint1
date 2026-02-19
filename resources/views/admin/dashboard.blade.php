<x-layouts.app title="Admin Dashboard">

    <div class="container py-4">

        {{-- Page Header --}}
        <div class="mb-5 text-center">
            <h2 class="font-weight-bold">Admin Dashboard</h2>
            <p class="text-muted mb-0">
                Manage users, posts, categories, and roles.
            </p>
        </div>

        {{-- Stats Cards --}}
        <div class="row justify-content-center">

            <x-user :users="$users" />
            <x-post :posts="$posts" />

            {{-- Categories Card --}}
            <x-category :categories="$categories" />

        </div>

    </div>

</x-layouts.app>