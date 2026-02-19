<x-layouts.app title="User Management">
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h2 class="mb-4">User Management</h2>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td class="font-weight-bold">
                                {{ $user->name }}
                            </td>

                            <td>
                                {{ $user->email }}
                            </td>

                            {{-- Role Column --}}
                            <td>
                                <div class="d-flex align-items-center">
                                    @foreach ($user->roles as $role)
                                    <span class="badge 
                                            @if($role->name == 'admin') badge-danger
                                            @elseif($role->name == 'editor') badge-warning
                                            @else badge-secondary
                                            @endif">
                                        {{ ucfirst($role->name) }}
                                    </span>
                                    @endforeach

                                    <a href="{{ route('admin.user.role.edit', $user->id) }}"
                                        class="btn btn-sm btn-outline-primary ml-2">
                                        Edit
                                    </a>
                                </div>
                            </td>

                            {{-- Delete Action --}}
                            <td class="text-center">
                                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $users->links() }}
            </div>

        </div>
    </div>
</x-layouts.app>