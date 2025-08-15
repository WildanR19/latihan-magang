@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <!-- Post Card -->
                <div class="card shadow-sm border-0">
                    <img src="{{ $post->image }}" class="card-img-top" alt="Post Image">
                    <div class="card-body">
                        <h1 class="card-title">{{ $post->title }}</h1>
                        <p class="text-muted mb-2">
                            <small>Ditulis oleh <strong>{{ $post->creator?->name }}</strong> •
                                {{ $post->created_at->format('d F Y') }}</small>
                        </p>
                        <hr>
                        <p class="card-text">
                            {{ $post->content }}
                        </p>
                    </div>
                </div>

                <!-- Comment Section -->
                <div class="mt-5">
                    <h4>Komentar</h4>
                    <form method="POST" action="{{ route('comments.store', $post->id) }}">
                        @csrf
                        <div class="mb-3">
                            <textarea class="form-control" name="comment" rows="3"
                                placeholder="Tulis komentar..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>

                    <div class="mt-4">
                        @forelse ($post->comments as $comment)
                            <div class="d-flex mb-3">
                                <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="User">
                                <div>
                                    <h6 class="mb-0">{{ $comment->user?->name }} <small class="text-muted">•
                                            {{ $comment->created_at->diffForHumans() }}</small></h6>
                                    <p class="mb-0">{{ $comment->comment }}.</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">Belum ada komentar.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection