@extends('layouts.app')

@section('title'){{$post['title']}}@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            Post info
        </div>
        <div class="card-body">
            <div>
                <span style="font-size: 1.2rem; font-weight: bold">Title: </span>
                {{$post->title}}
            </div>
            <div>
                <span style="font-size: 1rem; font-weight: bold">Creator: </span>
                @if($post->user)
                <td>{{$post->user->name}}</td>
                @else
                    <td>Not Found</td>
                @endif
            </div>
        </div>
    </div>

    @if($post->user)
    <div class="card">
        <div class="card-header">Creator Info</div>
        <div class="card-body">
            <div>
                <span style="font-size: 1.2rem; font-weight: bold">Name: </span>
                {{$post->user->name}}
            </div>
            <div>
                <span style="font-size: 1.2rem; font-weight: bold">Email: </span>
                {{$post->user->email}}
            </div>
            <div>
                <span style="font-size: 1.2rem; font-weight: bold">Created At: </span>
                {{ \Carbon\Carbon::parse($post->user->created_at)->format('l jS \\of F Y h:i:s A') }}
            </div>
        </div>
    </div>
    @endif

    <div class="card">
        <div class="card-header">
            Comments
        </div>
        <div class="card-body">
                <form action="{{route('posts.comments.store', ['post' => $post['id'], 'type' => get_class($post)])}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea name="body" id="body" cols="15" rows="4" class="form-control" placeholder="Your comment here"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Post Creator</label>
                        <select name="user_id" class="form-control">
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Add Comment</button>
                    </div>
                </form>
            @if(count($post->comments) > 0)
                @foreach($post->comments as $comment)
                    <div class="card">
                        <div class="card-header">
                            {{$comment->user->name}}
                        </div>
                        <div class="card-body">
                            <div>
                                <span style="font-size: 1.2rem; font-weight: bold">Comment: </span>
                                {{$comment->body}}
                            </div>
                            <div>
                                <span style="font-size: 1rem; font-weight: bold">Created At: </span>
                                {{ \Carbon\Carbon::parse($comment->created_at)->format('l jS \\of F Y h:i:s A') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div>No comments yet</div>
            @endif
        </div>
    </div>
@endsection