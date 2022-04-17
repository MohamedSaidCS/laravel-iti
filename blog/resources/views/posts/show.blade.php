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
@endsection