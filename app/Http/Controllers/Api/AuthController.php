<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function token(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }
            
        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token');
    
        return ['token' => $token->plainTextToken, 'token_type' => 'Bearer',];
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return ['status' => 'success', 'message' => 'Token '. $request->bearerToken() .' deleted'];
    }
}
