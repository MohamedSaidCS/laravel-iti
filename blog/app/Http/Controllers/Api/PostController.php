<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index()
    {
        return PostResource::collection(Post::paginate(10));
    }

    public function show($postId)
    {
        $post = Post::find($postId);

        if(!$post) {
            return response()->json([
                'message' => 'Post not found'
            ], 404);
        }

        return new PostResource($post);
    }

    public function store()
    {
        request()->validate([
            'title' => 'required|min:3|unique:posts',
            'description' => 'required|min:10',
            'user_id' => 'required|exists:users,id',
        ]);

        $data = request()->all();

          $post = Post::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => $data['user_id'],

        ]);

        return new PostResource($post);
    }
}