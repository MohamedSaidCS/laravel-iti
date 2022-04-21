@extends('layouts.app')

@section('title')Index @endsection

@section('content')
        <div class="text-center">
            <a href="{{ route('posts.create') }}" class="mt-4 btn btn-success">Create Post</a>
        </div>
        <table class="table mt-4">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Slug</th>
                <th scope="col">Title</th>
                <th scope="col">Posted By</th>
                <th scope="col">Image</th>
                <th scope="col">Created At</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
            @foreach ( $posts as $post)        
              <tr>
                <td>{{ $post->id }}</th>
                  <td>{{ $post->slug }}</th>
                <td>{{ $post->title }}</td>
                @if($post->user)
                  <td>{{$post->user->name}}</td>
                @else
                  <td>Not Found</td>
                @endif
                <td style="width: 10%"><img class="img-fluid" src="http://127.0.0.1:8000/{{$post->image}}"></td>
                <td>{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('posts.show', ['post' => $post->id]) }}" class="btn btn-info">View</a>
                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ route('posts.delete', ['post' => $post->id]) }}" class="btn btn-danger">Delete</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $posts->links('pagination::bootstrap-4') }}
@endsection
 