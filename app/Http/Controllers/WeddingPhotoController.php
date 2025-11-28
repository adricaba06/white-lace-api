<?php

namespace App\Http\Controllers;

use App\Models\WeddingPhoto;
use Illuminate\Http\Request;

class WeddingPhotoController extends Controller
{
    public function index()
    {
        return response()->json(WeddingPhoto::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'wedding_id' => 'required|exists:weddings,id',
            'uploaded_by_user_id' => 'required|exists:users,id',
            'url' => 'required|string|max:500',
            'caption' => 'nullable|string',
        ]);

        $photo = WeddingPhoto::create($validated);
        return response()->json($photo, 201);
    }

    public function show(WeddingPhoto $weddingPhoto)
    {
        return response()->json($weddingPhoto);
    }

    public function update(Request $request, WeddingPhoto $weddingPhoto)
    {
        $validated = $request->validate([
            'url' => 'sometimes|string|max:500',
            'caption' => 'nullable|string',
        ]);

        $weddingPhoto->update($validated);
        return response()->json($weddingPhoto);
    }

    public function destroy(WeddingPhoto $weddingPhoto)
    {
        $weddingPhoto->delete();
        return response()->json(['message' => 'Wedding photo deleted successfully']);
    }
}
