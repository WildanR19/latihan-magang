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
                    <div class="mb-3">
                        <textarea class="form-control" rows="3" placeholder="Tulis komentar..."></textarea>
                    </div>
                    <button class="btn btn-primary">Kirim</button>

                    <div class="mt-4">
                        <div class="d-flex mb-3">
                            <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="User">
                            <div>
                                <h6 class="mb-0">User 1 <small class="text-muted">• 2 jam lalu</small></h6>
                                <p class="mb-0">Komentar pertama di post ini.</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <img src="https://via.placeholder.com/50" class="rounded-circle me-3" alt="User">
                            <div>
                                <h6 class="mb-0">User 2 <small class="text-muted">• 5 jam lalu</small></h6>
                                <p class="mb-0">Komentar kedua di post ini.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection