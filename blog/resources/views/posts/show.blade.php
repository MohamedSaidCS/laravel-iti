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
@endsection