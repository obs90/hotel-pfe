<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CustomUser;
use Illuminate\Http\Request;

class CustomUserController extends Controller
{
    
    public function index()
    {
        $users = CustomUser::all();
        return response()->json($users);
    }

    
    public function show($id)
    {
        $user = CustomUser::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:custom_users,email',
            'telephone' => 'required|string|max:20',
            'password' => 'required|string|min:6',
            'typeUser' => 'required|in:client,employe',
        ]);

        $user = CustomUser::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => bcrypt($request->mot_de_passe),
            'typeUser' => $request->typeUser,
        ]);

        return response()->json($user, 201);
    }

    
    public function update(Request $request, $id)
    {
        $user = CustomUser::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $request->validate([
            'nom' => 'sometimes|required|string|max:255',
            'prenom' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:custom_users,email,' . $id,
            'telephone' => 'sometimes|required|string|max:20',
            'password' => 'sometimes|required|string|min:6',
            'typeUser' => 'sometimes|required|in:client,employe',
        ]);

        $user->update($request->all());

        return response()->json($user);
    }

    
    public function destroy($id)
    {
        $user = CustomUser::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Delete related client or employe
        if ($user->typeUser === 'client') {
            $user->client()->delete();
        } elseif ($user->typeUser === 'employe') {
            $user->employe()->delete();
        }

        // Delete user
        $user->delete();

        return response()->json(['message' => 'User and related data deleted successfully']);
    }


    public function getUsersByType($type)
{
    
    if (!in_array($type, ['client', 'employe'])) {
        return response()->json(['message' => 'Invalid user type'], 400);
    }

    
    $users = CustomUser::where('typeUser', $type)->get();

    return response()->json($users);
}

}
 