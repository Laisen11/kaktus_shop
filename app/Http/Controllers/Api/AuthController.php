<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $request->validate([
            'email' => 'email|string|required',
            'password' => 'required|string|min:6'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = User::where('email', $request->email)->first();

        if (!Hash::check($request->password, $user->password, [])) {
            return response()->json([
                'message' => 'Request not match'
            ], 401);
        }

        $tokenResult = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'access_token' => $tokenResult,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 200);
    }

    public function register()
    {
        $this->validate(request(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string'
        ]);

        $user = User::create(request(['name', 'email', 'password']));

        $tokenResult = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'access_token' => $tokenResult,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 200);
    }

    public function logout(Request $request)
    {
        if ($request->user()) {
            $result = $request->user()->currentAccessToken()->delete();

            return response()->json([
                'message' => $result ? 'Successfully logged out' : 'Failed logout'
            ], 200);
        }

        return response()->json([
            'message' => 'No have session'
        ], 401);
    }
}
