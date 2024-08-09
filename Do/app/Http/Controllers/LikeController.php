<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $likes = Like::get();
        return response()->json($likes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $like = new Like();
        $like->user_id = $request->user_id;
        $like->comment_id = $request->comment_id;
        $like->is_like = $request->is_like;

        $like->save();

        return response()->json($like);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $likes = Like::where('comment_id', $id);
        return response()->json($likes);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}