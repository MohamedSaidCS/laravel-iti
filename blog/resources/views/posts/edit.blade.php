@extends('layouts.app')

@section('title')Edit @endsection

@section('content')
        <form method="POST" action="{{ route('posts.update', ['post' => $post['id']]) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input name="title" type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $post->title }}">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $post->description }}</textarea>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Post Creator</label>
                <select name="user_id" class="form-control">
                    @foreach ($users as $user)
                    <option value="{{$user->id}}" {{ $post->user_id == $user->id ? 'selected' : '' }}>{{$user->name}}</option>
                    @endforeach
                </select>
            </div>

          <button class="btn btn-primary">Edit</button>
        </form>
@endsection
