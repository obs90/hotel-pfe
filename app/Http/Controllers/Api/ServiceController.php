<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Employe;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // List all services with chef and employees
    public function index()
    {
        $services = Service::with(['chef', 'employes'])->get();
        return response()->json($services);
    }

    // Show a single service
    public function show($id)
    {
        $service = Service::with(['chef', 'employes'])->findOrFail($id);
        return response()->json($service);
    }

    // Create a new service
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'id_chef' => 'nullable|exists:employes,id_employe',
        ]);
    
        // Check if a chef was provided
        if ($request->id_chef) {
            $chef = Employe::findOrFail($request->id_chef);
    
            // ❌ Check if the employee's function is 'chef'
            if ($chef->fonction !== 'chef') {
                return response()->json(['error' => 'The selected employee is not a chef.'], 422);
            }
    
            // ❌ Check if the chef is already assigned to another service
            $alreadyChef = Service::where('id_chef', $chef->id_employe)->exists();
            if ($alreadyChef) {
                return response()->json(['error' => 'This chef is already assigned to another service.'], 422);
            }
        }
    
        // ✅ Create the service
        $service = Service::create([
            'nom' => $request->nom,
            'id_chef' => $request->id_chef,
        ]);
    
        // ✅ Update the chef's id_service (if assigned)
        if ($request->id_chef) {
            $chef->id_service = $service->id_service;
            $chef->save();
        }
    
        return response()->json(['message' => 'Service created successfully', 'service' => $service], 201);

    }

    // Update a service
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'id_chef' => 'nullable|exists:employes,id_employe',
        ]);

        $newChefId = $validated['id_chef'] ?? null;
        $oldChefId = $service->id_chef;

        // Step 1: If the new chef is assigned to another service, remove them from that old service
        if ($newChefId) {
            $otherService = Service::where('id_chef', $newChefId)->where('id_service', '!=', $service->id_service)->first();
            if ($otherService) {
                $otherService->update(['id_chef' => null]);
            }
        }

        // Step 2: Update the service
        $service->update([
            'nom' => $validated['nom'],
            'id_chef' => $newChefId,
        ]);

        // Step 3: Update new chef's id_service
        if ($newChefId) {
            Employe::where('id_employe', $newChefId)->update(['id_service' => $service->id_service]);
        }

        // Step 4: Reset old chef's id_service if it changed
        if ($oldChefId && $oldChefId != $newChefId) {
            Employe::where('id_employe', $oldChefId)->update(['id_service' => null]);
        }

        return response()->json([
            'message' => 'Service updated successfully.',
            'service' => $service->load('chef'),
        ]);
    }


    // Delete a service
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return response()->json(['message' => 'Service deleted']);
    }
}
