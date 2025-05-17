<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    // Get all images
    public function index()
    {
        $images = Image::all();
        return response()->json($images);
    }

    // Get a single image
    public function show($id)
    {
        $image = Image::findOrFail($id);
        return response()->json($image);
    }

    // Store a new image
    public function store(Request $request)
    {
        $validated = $request->validate([
            'url' => 'required|string',
            'id_chambre' => 'required|exists:chambres,id',
        ]);

        $image = Image::create($validated);
        return response()->json($image, 201);
    }

    // Update an image
    public function update(Request $request, $id)
    {
        $image = Image::findOrFail($id);

        $validated = $request->validate([
            'url' => 'string',
            'id_chambre' => 'exists:chambres,id',
        ]);

        $image->update($validated);
        return response()->json($image);
    }

    // Delete an image
    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        $image->delete();

        return response()->json(['message' => 'Image deleted']);
    }
}
