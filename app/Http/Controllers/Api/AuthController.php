<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Helpers\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Termwind\Components\Hr;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|string|min:6'
        ]);
        $user =User::where('email',$request->email)->first();
        if(!$user || !Hash::check($request->password,$user->password)){
            return ApiResponse::error('Invalid credentials',null,401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return ApiResponse::success('User logged in successfully',[
            'access_token'=>$token
        ]);
    }

    public function register(Request $request){
        $data = $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|string|min:6'
        ]);
        $data['password']=Hash::make($data['password']);
        $user = User::create($data);
        $token = $user->createToken('auth_token')->plainTextToken;
        return ApiResponse::success('User registered successfully',[
            'access_token'=>$token,
            'code'=>201
        ]);
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return ApiResponse::success('User logged out successfully');
    }
}
