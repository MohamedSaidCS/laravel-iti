<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(10);

        return view('posts.index',[
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        $users = User::all();
        return view('posts.create', ['users' => $users]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|unique:posts',
            'description' => 'required|min:10',
            'user_id' => 'required|exists:users,id',
        ]);

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id
        ]);

        return to_route('posts.index');
    }

    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show', ['post' => $post, 'users' => User::all()]);
    }

    public function edit($id) {
        $post = Post::find($id);
        $users = User::all();

        return view('posts.edit', ['post' => $post, 'users' => $users]);
    }

    public function update(Request $request, $id) {
        $post = Post::find($id);

        $request->validate([
            'title' => 'required|min:3|unique:posts,title,' . $post->title . ',title',
            'description' => 'required|min:10',
        ]);

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        $users = User::all();

        return view('posts.show', ['post' => $post, 'users' => $users]);
    }

    public function delete($id) {
        $post = Post::find($id);

        return view('posts.delete', ['post' => $post]);
    }

    public function destroy($id) {
        Post::find($id)->delete();

        return to_route('posts.index');
    }
}
