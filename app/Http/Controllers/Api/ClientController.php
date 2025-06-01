<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        return response()->json(Client::with('user')->get());
    }

    public function show($id)
    {
        $client = Client::with('user')->find($id);

        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }

        return response()->json($client);
    }

    public function store(Request $request)
    {
        $request->validate([
            'CIN' => 'nullable|string|unique:clients,CIN',
            'id_user' => 'required|exists:custom_users,id_user',
        ]);

        $client = Client::create($request->all());

        return response()->json($client, 201);
    }

    public function update(Request $request, $id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }

        $request->validate([
            'CIN' => 'nullable|string|unique:clients,CIN,' . $id . ',id_client',
            'id_user' => 'sometimes|exists:custom_users,id_user',
        ]);

        $client->update($request->all());

        return response()->json($client);
    }

    public function destroy($id)
    {
        $client = Client::find($id);

        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }

        $client->delete();

        return response()->json(['message' => 'Client deleted successfully']);
    }

    public function reservations($id)
    {
        $client = Client::with('reservations')->find($id);

        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }

        return response()->json($client->reservations);
    }
}

