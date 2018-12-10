<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index($topic_id)
    {
        //return Post::all();
        //$posts = $this->user
        return Post::with('owner')->where('topic_id', $topic_id)->get();
    }

    public function show($topic_id, Post $post)
    {
        return $post;
    }

    public function store(Request $request, $topic_id)
    {
        $post_data = $request->only('body');
        $post_data['topic_id'] = $topic_id;
        $post_data['user_id'] = auth()->user()->id;

        $post = Post::create($post_data);

        return response()->json($post, 201);
    }

    public function update($topic_id, Request $request, Post $post)
    {
        if ($this->isAdmin() || auth()->user()['id'] == $post['user_id']) {

            $post->update($request->only('body'));
            return response()->json($post, 200);

        } else {
            return response()->json(['status' => 'Forbidden resource'], 403);
        }


    }

    public function delete($topic_id, Post $post)
    {
        if ($this->isAdmin() || auth()->user()['id'] == $post['user_id']) {

            $result = $post->delete();

            if ($result == true) {
                $resp = array(
                    'response' => true,
                );
                return response()->json([
                    'success' => true
                ], 200);
                //204 default?
            } else return 404;

        } else {
            return response()->json(['status' => 'Forbidden resource'], 403);
        }
    }

    private function isAdmin()
    {
        return auth()->user()->role['name'] == 'admin';
    }

}
