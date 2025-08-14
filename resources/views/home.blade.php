@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4">Blog Terbaru</h1>

        <div class="row g-4">
            @foreach ($posts as $post)
                <!-- Post 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 shadow-sm border-0">
                        <img src="{{ $post->image }}" class="card-img-top" alt="Post Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="text-muted mb-2">
                                <small>{{ $post->created_at->format('d F Y') }} • {{ $post->creator?->name }}</small>
                            </p>
                            <p class="card-text">
                                {{ $post->contentLimit }}
                            </p>
                            <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>

        {{ $posts->links() }}

    </div>
@endsection