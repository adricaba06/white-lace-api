<?php

namespace App\Http\Controllers;

use App\Models\Wedding;
use Illuminate\Http\Request;

class WeddingController extends Controller
{
    public function index()
    {
        return response()->json(Wedding::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'wedding_date' => 'required|date',
            'venue_name' => 'required|string|max:255',
            'venue_address' => 'nullable|string',
            'budget' => 'nullable|numeric',
            'dress_code' => 'nullable|string|max:100',
            'dress_code_details' => 'nullable|string',
            'are_kids_allowed' => 'boolean',
        ]);

        $wedding = Wedding::create($validated);
        return response()->json($wedding, 201);
    }

    public function show(Wedding $wedding)
    {
        return response()->json($wedding);
    }

    public function update(Request $request, Wedding $wedding)
{
    $validated = $request->validate([
        'wedding_date' => 'sometimes|date',
        'venue_name' => 'sometimes|string|max:255',
        'venue_address' => 'sometimes|nullable|string',
        'budget' => 'sometimes|nullable|numeric',
        'dress_code' => 'sometimes|nullable|string|max:100',
        'dress_code_details' => 'sometimes|nullable|string',
        'are_kids_allowed' => 'sometimes|boolean',
    ]);

    $wedding->update($validated);
    $wedding->refresh(); 

    return response()->json($wedding, 200);
}


    public function destroy(Wedding $wedding)
    {
        $wedding->delete();
        return response()->json(['message' => 'Wedding deleted successfully']);
    }
}
