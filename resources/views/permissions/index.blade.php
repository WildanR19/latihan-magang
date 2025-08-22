@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Permissions Management</h2>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-4">
                <strong>Terjadi kesalahan:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- User Create/Edit Form -->
        <div class="card mb-4">
            <div class="card-header">Add / Edit Permission</div>
            <div class="card-body">
                <form
                    action="{{ isset($permission) ? route('permissions.update', $permission->id) : route('permissions.store') }}"
                    method="POST">
                    @csrf
                    @if(isset($permission))
                        @method('PUT')
                    @endif
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $permission->name ?? old('name') }}"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ isset($permission) ? 'Update' : 'Create' }}</button>
                    @if(isset($permission))
                        <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Cancel</a>
                    @endif
                </form>
            </div>
        </div>

        <!-- Permission Table -->
        <div class="card">
            <div class="card-header">Permission List</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permissions as $index => $permission)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <a href="{{ route('permissions.edit', $permission->id) }}"
                                        class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No permissions found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $permissions->links() }}
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endsection