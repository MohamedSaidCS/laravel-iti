<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3|unique:posts',
            'description' => 'required|min:10',
            'user_id' => 'required|exists:users,id',
            'image' => 'required|mimes:jpeg,png,jpg,gif'
        ]);

        $path = $request->file('image')->store('public/images');

        Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'image' => str_replace('public', 'storage', $path)
        ]);

        return to_route('posts.index');
    }

    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show', ['post' => $post]);
    }

    public function edit($id) {
        $post = Post::find($id);

        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, $id) {
        $post = Post::find($id);

        $request->validate([
            'title' => 'required|min:3|unique:posts,title,' . $post->title . ',title',
            'description' => 'required|min:10',
            'image' => 'mimes:jpeg,png,jpg,gif'
        ]);

        if($request->file('image')) {
            Storage::delete(str_replace('storage', 'public', $post->image));
            $path = $request->file('image')->store('public/images');
        } else {
            $path = $post->image;
        }

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'image' => str_replace('public', 'storage', $path)
        ]);

        return view('posts.show', ['post' => $post]);
    }

    public function delete($id) {
        $post = Post::find($id);

        return view('posts.delete', ['post' => $post]);
    }

    public function destroy($id) {
        $post = Post::find($id);

        Storage::delete(str_replace('storage', 'public', $post->image));

        $post->delete();

        return to_route('posts.index');
    }
}
