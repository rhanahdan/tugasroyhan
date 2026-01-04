@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3>Posts</h3>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">Add New Post</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($post->image)
                            <img src="{{ Storage::url($post->image) }}" width="50" alt="Img">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>{{ Str::limit($post->title, 30) }}</td>
                    <td>{{ $post->category->name }}</td>
                    <td>
                        <span class="badge bg-{{ $post->status == 'published' ? 'success' : 'secondary' }}">
                            {{ ucfirst($post->status) }}
                        </span>
                    </td>
                    <td>{{ $post->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
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

        {{ $posts->links() }}
    </div>
</div>
@endsection
