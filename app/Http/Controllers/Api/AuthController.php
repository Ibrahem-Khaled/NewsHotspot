<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        $user->last_login_at = Carbon::now();
        $user->save();

        return $this->respondWithToken($token);
    }

    public function register(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'displayname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $imageName = null;
        if ($request->hasFile('profile_picture')) {
            $imageName = $request->file('profile_picture')->store('images/users');
        }
        $user = User::create([
            'username' => $request->username,
            'displayname' => $request->displayname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'profile_picture' => $imageName,
        ]);
        $token = JWTAuth::fromUser($user);
        return response()->json(['token' => $token], 201);
    }


    public function me(Request $request)
    {
        try {
            $user = JWTAuth::setToken($request->token)->toUser();
            if (!$user) {
                return null;
            }
            return $user;
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return null;
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return null;
        }
    }

    public function logout(Request $request)
    {
        JWTAuth::logout($request->token);
        return response()->json(['message' => 'Successfully logged out']);
    }
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
