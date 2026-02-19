<div class="col-md-6 col-lg-3 d-flex mb-4">
    <div class="card border-0 shadow-sm h-100 w-100 dashboard-card">
        <div class="card-body d-flex justify-content-between align-items-center">

            {{-- Left Side --}}
            <div>
                <h6 class="text-uppercase text-muted mb-2">Categories</h6>

                <h2 class="font-weight-bold mb-1">
                    {{ $categories }}
                </h2>

                <p class="text-muted small mb-3">
                    Available categories
                </p>

                <a href="{{ route('admin.category') }}" class="btn btn-sm btn-warning text-white">
                    <i class="fas fa-arrow-right mr-1"></i> View Details
                </a>
            </div>

            {{-- Right Icon --}}
            <div class="text-warning">
                <i class="fas fa-folder-open"></i>
            </div>

        </div>
    </div>
</div>