<x-layouts.app title="Edit User Roles">
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h2 class="mb-4">Edit Roles for {{ $user->name }}</h2>

            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>User Information</h5>
                    <p><strong>Name:</strong> {{ $user->name }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Joined:</strong> {{ $user->created_at->format('M d, Y') }}</p>
                </div>
                <div class="col-md-6">
                    <h5>Current Roles</h5>
                    @if($user->roles->count() > 0)
                        @foreach($user->roles as $role)
                            <span class="badge
                                @if($role->name == 'admin') badge-danger
                                @elseif($role->name == 'editor') badge-warning
                                @else badge-secondary
                                @endif mr-1">
                                {{ ucfirst($role->name) }}
                            </span>
                        @endforeach
                    @else
                        <p class="text-muted">No roles assigned</p>
                    @endif
                </div>
            </div>

            <form action="{{ route('admin.user.role.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="roles">Assign Roles</label>
                    <div class="row">
                        @foreach($roles as $role)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}" id="role-{{ $role->id }}"
                                        {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="role-{{ $role->id }}">
                                        {{ ucfirst($role->name) }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">Update Roles</button>
                    <a href="{{ route('admin.user') }}" class="btn btn-secondary ml-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
