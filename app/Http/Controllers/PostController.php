<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index($topic_id)
    {
        //return Post::all();
        return Post::where('topic_id', $topic_id)->get();
    }

    public function show($topic_id, Post $post)
    {
        return $post;
    }

    public function store(Request $request, $topic_id)
    {
        $post = Post::create($request->all());

        //return response()->json($request->only(['topic_id', 'user_id']), 201);

        return response()->json($post, 201);
    }

    public function update($topic_id, Request $request, Post $post)
    {
        $post->update($request->all());

        return response()->json($post, 200);
    }

    public function delete($topic_id, Post $post)
    {
        $result = $post->delete();

        if ($result == true) {
            $resp = array(
                'response' => true,
            );
            return response()->json([
                'success' => true
            ], 200);
            //204 default?
        }
        else return 404;
    }
}
