<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

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

    // Store one or multiple images
    public function store(Request $request)
    {
        $request->validate([
            'id_chambre' => ['required', Rule::exists('chambres', 'id_chambre')],
            'images.*' => 'required|image|max:2048',
        ]);

        $imagePaths = [];

        foreach ($request->file('images') as $file) {
            $path = $file->store('chambres', 'public');

            $image = Image::create([
                'url' => $path,
                'id_chambre' => $request->id_chambre,
            ]);

            $imagePaths[] = $image;
        }

        return response()->json($imagePaths, 201);
    }

    // Update an image (only one at a time)
    public function update(Request $request, $id)
    {
        $image = Image::findOrFail($id);

        $validated = $request->validate([
            'id_chambre' => ['sometimes', Rule::exists('chambres', 'id_chambre')],
            'image' => 'sometimes|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Supprimer l’ancienne image
            Storage::disk('public')->delete($image->url);

            // Stocker la nouvelle image
            $path = $request->file('image')->store('chambres', 'public');
            $validated['url'] = $path;
        }

        $image->update($validated);

        return response()->json($image);
    }

    // Delete an image
    public function destroy($id)
    {
        $image = Image::findOrFail($id);

        // Supprimer le fichier de stockage
        Storage::disk('public')->delete($image->url);

        $image->delete();

        return response()->json(['message' => 'Image supprimée avec succès']);
    }
}