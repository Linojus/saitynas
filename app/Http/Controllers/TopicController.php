<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index()
    {
        return Topic::all();
    }

    public function show(Topic $topic)
    {
        return $topic;
    }

    public function store(Request $request)
    {
        $topic = Topic::create($request->all());

        return response()->json($topic, 201);
    }

    public function update(Request $request, Topic $topic)
    {
        $topic->update($request->all());

        return response()->json($topic, 200);
    }

    public function delete(Topic $topic)
    {
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
    }
}
