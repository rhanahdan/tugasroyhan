@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Article -->
            <div class="card shadow-sm mb-4">
                @if($post->image)
                    <img src="{{ Storage::url($post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                @endif
                <div class="card-body">
                    <h1 class="card-title mb-3">{{ $post->title }}</h1>
                    <div class="text-muted mb-3">
                        By <strong>{{ $post->user->name }}</strong> | 
                        <a href="{{ route('categories.show', $post->category->slug) }}" class="text-decoration-none">{{ $post->category->name }}</a> | 
                        {{ $post->created_at->format('d F Y') }}
                    </div>
                    <hr>
                    <div class="card-text content-body">
                        {!! $post->content !!}
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="card shadow-sm">
                <div class="card-header bg-light">Comments ({{ $comments->count() }})</div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- List Comments -->
                    <ul class="list-unstyled mb-4">
                        @forelse($comments as $comment)
                        <li class="media mb-3 border-bottom pb-3">
                            <div class="media-body">
                                <h5 class="mt-0 mb-1 fw-bold">{{ $comment->name }}</h5>
                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                <p class="mt-1">{{ $comment->content }}</p>
                            </div>
                        </li>
                        @empty
                        <p class="text-muted">No comments yet. Be the first to comment!</p>
                        @endforelse
                    </ul>

                    <!-- Comment Form -->
                    <h5 class="mb-3">Leave a specific Comment</h5>
                    <form action="{{ route('comments.store', $post->slug) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Comment</label>
                            <textarea name="content" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Comment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
