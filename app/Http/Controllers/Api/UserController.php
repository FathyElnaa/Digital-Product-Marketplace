<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ApiResponse::success('Users Fetched Successfully', ['Users' => UserResource::collection(User::all())]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $date = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|',
            'role' => 'required|in:admin,vendor,customer',
        ]);
        $date['password'] = Hash::make($date['password']); 
        $user = User::create($date);
        return ApiResponse::success('User Created Successfully', ['User' => $user], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return ApiResponse::success('User Show Successfully', ['User' => new UserResource($user)], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|',
            'role' => 'required|in:admin,vendor,customer',
        ]);

        $data = $request->only(['name', 'email', 'role']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);
        return ApiResponse::success('User Updated Successfully', ['User' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (!$user) {
            return ApiResponse::error('User Not Found', [], 404);
        }

        $user->delete();
        return ApiResponse::success('User Deleted Successfully', [], 200);
    }
}
