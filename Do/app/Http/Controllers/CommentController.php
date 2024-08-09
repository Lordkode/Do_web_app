<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Topic;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = DB::table('comments')->orderby('created_at', 'desc')->get();
        return response()->json($comments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        $comment = new Comment();
        $comment->note = $request->note;
        $comment->title = $request->title;
        $comment->description = $request->description;
        $comment->user_id = $request->user_id;
        $comment->topic_id = $request->topic_id;

        $comment->save();

        return response()->json($comment);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Comment::where('id', $id)->exists()) {
            $comment = Comment::find($id);
            return response()->json($comment);
        } else {
            return response()->json(["Comment Not Found."], 404);
        }
    }

    public function showComments($topic_id)
    {
        $comments = Comment::where('topic_id', $topic_id);
        dd($comments);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (Comment::where('id', $id)->exists()) {
            $comment = Comment::find($id);
            if ($comment->user()->id === $request->user()->id) {
                $comment->note = is_null($request->note) ? $comment->note : $request->note;
                $comment->title = is_null($request->title) ? $comment->title : $request->title;
                $comment->description = is_null($request->description) ? $comment->description : $request->description;
                $comment->save();
                return response()->json(["message" => "Comment Updated."]);
            } else {
                return response()->json(["message" => "You can't update this comment"], 412);
            }
        } else {
            return response()->json(["message" => "Comment Not Found."], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if (Comment::where('id', $id)->exists()) {
            $comment = Comment::find($id);
            if ($comment->user()->id === $request->user()->id()) {
                $comment->delete();
                return response()->json(["message" => "Comment Deleted."]);
            } else {
                return response()->json(["message" => "You can't update this comment"], 412);
            }
        } else {
            return response()->json(["message" => "Comment Not Found."], 404);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function kpi()
    {
        $comments = Comment::get();
        $users = User::get();
        $topics = Topic::get();
        $date = \Carbon\Carbon::today()->subDays(7);
        $users7 = User::where('created_at', '>=', $date)->get();
        $comments7 = Comment::where('created_at', '>=', $date)->get();
        $topicByCommment = Topic::has('comments')->get();
        // $comments_each_day = DB::table('comments')->join('users', 'users.id', '=', 'comments.user_id')->select('comments.*')->groupBy('users.username')->get();

        return [
            "Commentlast7days" => count($comments7),
            "Userlast7days" => count($users7),
            "TotalUser" => count($users),
            "TotalTopic" => count($topics),
            "TopicByComment" => $topicByCommment
        ];
    }
}
