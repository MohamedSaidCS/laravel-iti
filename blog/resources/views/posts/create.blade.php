@extends('layouts.app')

@section('title')Create @endsection

@section('content')
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="POST" action="{{ route('posts.store', ['user_id' => Auth::id()])}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Title</label>
                <input name="title" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Image</label>
                <input type="file" class="form-control" name="image">
            </div>
          <button class="btn btn-success">Create</button>
        </form>
@endsection
