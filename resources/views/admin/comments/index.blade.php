@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Comments Moderation</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Comment</th>
                    <th>Post</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($comments as $comment)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $comment->name }}</td>
                    <td>{{ $comment->email }}</td>
                    <td>{{ Str::limit($comment->content, 50) }}</td>
                    <td>{{ $comment->post->title ?? 'Deleted Post' }}</td>
                    <td>
                        <span class="badge bg-{{ $comment->status == 'approved' ? 'success' : 'warning' }}">
                            {{ ucfirst($comment->status) }}
                        </span>
                    </td>
                    <td>
                        @if($comment->status == 'pending')
                        <form action="{{ route('admin.comments.approve', $comment) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm btn-success">Approve</button>
                        </form>
                        @endif
                        <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this comment?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No comments found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $comments->links() }}
    </div>
</div>
@endsection
