<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;
use \App\User;

class TopicController extends Controller
{
    public function index()
    {
       // return response()->json(['status' => auth()->user()->posts ]);
        return Topic::with('owner')->orderBy('updated_at', 'DESC')->orderBy('id', 'desc')->get();
    }

    public function show(Topic $topic)
    {
        $owner_data = $topic->owner;
       // $topic['owner'] = $owner_data['name'];
        return $topic;
    }

    public function store(Request $request)
    {
        $topic_data = $request->only('title', 'body');
        $topic_data['user_id'] = auth()->user()->id;

        $topic = Topic::create($topic_data);

        return response()->json($topic, 201);
    }

    public function update(Request $request, Topic $topic)
    {
        if ($this->isAdmin() || auth()->user()['id'] == $topic['user_id']) {

            $topic->update($request->only('title', 'body'));
            return response()->json($topic, 200);

        } else {
            return response()->json(['status' => 'Forbidden resource'], 403);
        }
    }

    public function delete(Topic $topic)
    {

        if ($this->isAdmin() || auth()->user()['id'] == $topic['user_id']) {

            $result = $topic->delete();

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

        } else {
            return response()->json(['status' => 'Forbidden resource'], 403);
        }

    }

    private function isAdmin() {
        return auth()->user()->role['name'] == 'admin';
    }

}
