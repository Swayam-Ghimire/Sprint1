<div class="col-md-6 col-lg-3 mb-4">
    <div class="card border-0 shadow-sm h-100 dashboard-card">
        <div class="card-body d-flex justify-content-between align-items-center">

            {{-- Left Side --}}
            <div>
                <h6 class="text-uppercase text-muted mb-2">Posts</h6>

                <h2 class="font-weight-bold mb-1">
                    {{ $posts }}
                </h2>

                <p class="text-muted small mb-3">
                    Total published posts
                </p>

                <a href="{{ route('admin.post') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-arrow-right mr-1"></i> View Details
                </a>
            </div>

            {{-- Right Icon --}}
            <div class="text-success">
                <i class="fas fa-file"></i>
            </div>

        </div>
    </div>
</div>