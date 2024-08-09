<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTopicRequest;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topics = DB::table('topics')->orderBy('created_at', 'desc')->get();
        return response()->json($topics);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTopicRequest $request)
    {
        $topic = new Topic();
        $topic->title = $request->title;
        $topic->description = $request->description;
        $topic->url = $request->url;
        $topic->user_id  = $request->user_id;

        $topic->save();
        
        return response()->json($topic);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $topic = Topic::find($id);
        return response()->json($topic);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Topic::where('id', $id)->exists()) {
            $topic = Topic::find($id);
            if ($topic->user()->id === $request->user()->id) {
                $topic->title = is_null($request->title) ? $topic->title : $request->title;
                $topic->description = is_null($request->description) ? $topic->description : $request->description;
                $topic->url = is_null($request->url) ? $topic->url : $request->url;
                $topic->user_id = is_null($request->user_id) ? $topic->user_id : $request->user_id;
                $topic->save();

                return response()->json([
                    "message" => "Topic Updated."
                ]);
            } else {
                return response()->json(["message" => "You can't update this comment"], 412);
            }
        } else {
            return response()->json([
                "message" => "Topic Not Found."
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if (Topic::where('id', $id)->exists()) {
            $topic = Topic::find($id);
            if ($topic->user()->id === $request->user()->id) {
                $topic->delete();

                return response()->json([
                    'message' => 'Topic Deleted.'
                ]);
            } else {
                return response()->json(["message" => "You can't update this comment"], 412);
            }
        } else {
            return response()->json([
                'message' => 'Topic Not Found.'
            ]);
        }
    }
}
