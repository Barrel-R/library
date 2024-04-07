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
        $users = User::all(); // if dataset gets large, paginate(50)
        return response()->json($users);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return response()->json(User::find($id));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string', 'password' => 'required|string', 'email' => 'required|email']);
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(['name' => 'sometimes|string', 'password' => 'sometimes|string', 'email' => 'sometimes|email']);
        $user = User::find($id)->update($request->all());;
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!User::where('id', $id)->exists()) return response()->json(['error' => 'There is no User with id ' . $id . ' in our records.'], 400);
        User::destroy($id);
        return response()->json(['message' => 'User deleted successfully.'], 200);
    }
}
