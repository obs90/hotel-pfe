<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\CustomUser;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:custom_users,email',
            'telephone' => 'required|string|max:20',
            'password' => 'required|string|min:6',
            'typeUser' => 'required|in:client,employe',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = CustomUser::create([
            'nom' => $request->get('nom'),
            'prenom' => $request->get('prenom'),
            'email' => $request->get('email'),
            'telephone' => $request->get('telephone'),
            'password' => Hash::make($request->get('password')),
            'typeUser' => $request->get('typeUser'),
        ]);

        if ($user->typeUser == 'client') {
            $user->client()->create(['CIN' => "", 'id_user' => $user->id_user]);
        } // elseif ($user->typeUser == 'employe') {
        //     $user->employe()->create();
        // }

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'), 201);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }

            // Get the authenticated user.
            $user = auth()->user();


            return response()->json(compact('token'));
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }
    }

    public function getUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'User not found'], 404);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Invalid token'], 400);
        }

        return response()->json(compact('user'));
    }

    public function logout()
    {
        // Invalidate the current token
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        // Refresh the JWT token and return a new one
        return response()->json([
            'access_token' => auth()->refresh(),
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60, // Token expiration time in minutes
        ]);
    }
}
 