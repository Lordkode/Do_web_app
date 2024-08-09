<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (User::where('id', $id)->exists()) {
            $user = User::find($id);
            return response()->json($user);
        } else {
            return response()->json(["User Not Found."]);
        }
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
        if (User::where('id', $id)->exists()) {
            User::destroy($id);
            return response()->json(["message"=>"User Deleted."], 202);
        }else{
            return response()->json(["message"=>"User Not Found."], 404);
        }
    }
}
