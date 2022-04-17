@extends('layouts.app')

@section('title')Delete @endsection

@section('content')
        <form method="POST" action="{{ route('posts.destroy', ['post' => $post['id']]) }}">
            @csrf
            @method('DELETE')
            <div class="mb-3">
                <label class="form-label">Are you sure you want to delete this post with id {{ $post['id'] }}?</label>
            </div>

          <button type="submit" class="btn btn-danger">Delete</button>
          <a onclick="window.location='{{ route("posts.index") }}'" class="btn btn-primary">Cancel</a>
        </form>
@endsection
