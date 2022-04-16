@extends('layouts.app')

@section('title')Edit @endsection

@section('content')
        <form method="POST" action="{{ route('posts.update', ['post' => $post['id']]) }}">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="{{ $post['title'] }}">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Post Creator</label>
                <select class="form-control">
                    <option value="1" {{ $post['id'] == 1 ? 'selected' : '' }}>Ahmed</option>
                    <option value="2" {{ $post['id'] == 2 ? 'selected' : '' }}>Mohamed</option>
                    <option value="3" {{ $post['id'] == 3 ? 'selected' : '' }}>Ali</option>
                </select>
            </div>

          <button class="btn btn-primary">Edit</button>
        </form>
@endsection
