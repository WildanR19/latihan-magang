@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Post Management</h2>

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

        <!-- Post Create/Edit Form -->
        <div class="card mb-4">
            <div class="card-header">Add / Edit Post</div>
            <div class="card-body">
                <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @if(isset($post))
                        @method('PUT')
                    @endif
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $post->title ?? old('title') }}">
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea name="content" class="form-control" rows="5"
                            required>{{ $post->content ?? old('content') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{ $post->slug ?? old('slug') }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="published_at" class="form-label">Published At</label>
                        <input type="datetime-local" name="published_at" class="form-control"
                            value="{{ $post->published_at ?? old('published_at') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" value="{{ $post->image ?? old('image') }}"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ isset($post) ? 'Update' : 'Create' }}</button>
                    @if(isset($post))
                        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
                    @endif
                </form>
            </div>
        </div>

        <!-- Post Table -->
        <div class="card">
            <div class="card-header">Post List</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Slug</th>
                            <th>Published At</th>
                            <th>Creator</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $index => $post)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <img src="{{ $post->image }}" alt="{{ $post->title }}" class="img-thumbnail" width="100">
                                </td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->content }}</td>
                                <td>{{ $post->slug }}</td>
                                <td>{{ $post->published_at }}</td>
                                <td>{{ $post->creator?->name }}</td>
                                <td>
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
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
                                <td colspan="7" class="text-center">No posts found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $data->links() }}
            </div>
        </div>
    </div>
@endsection