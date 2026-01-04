@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(isset($category))
        <div class="alert alert-info">Category: <strong>{{ $category->name }}</strong></div>
    @endif
    @if(isset($query))
        <div class="alert alert-info">Search Results for: <strong>{{ $query }}</strong></div>
    @endif

    <div class="row">
        <!-- Main Content (Posts) -->
        <div class="col-md-12">
            <div class="row">
                @forelse($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 post-card shadow-sm">
                        @if($post->image)
                            <img src="{{ Storage::url($post->image) }}" class="card-img-top" alt="{{ $post->title }}">
                        @else
                            <img src="https://via.placeholder.com/400x200?text=No+Image" class="card-img-top" alt="No Image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ route('posts.show', $post->slug) }}" class="text-decoration-none text-dark">{{ Str::limit($post->title, 50) }}</a></h5>
                            <p class="card-text text-muted small">
                                <span class="badge bg-secondary">{{ $post->category->name }}</span> | 
                                {{ $post->created_at->format('d M Y') }}
                            </p>
                            <p class="card-text">{{ Str::limit(strip_tags($post->content), 100) }}</p>
                            <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-sm btn-outline-primary">Read More</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <p class="text-center">No news available.</p>
                </div>
                @endforelse
            </div>
            
            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>

        <!-- Sidebar (Categories) -->

    </div>
</div>
@endsection
