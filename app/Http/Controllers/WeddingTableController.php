<?php

namespace App\Http\Controllers;

use App\Models\WeddingTable;
use Illuminate\Http\Request;

class WeddingTableController extends Controller
{
    public function index()
    {
        return response()->json(WeddingTable::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'wedding_id' => 'required|exists:weddings,id',
            'table_number' => 'required|integer|min:1',
            'table_name' => 'nullable|string|max:100',
            'max_capacity' => 'required|integer|min:1',
        ]);

        $table = WeddingTable::create($validated);
        return response()->json($table, 201);
    }

    public function show(WeddingTable $weddingTable)
    {
        return response()->json($weddingTable);
    }

    public function update(Request $request, WeddingTable $weddingTable)
    {
        $validated = $request->validate([
            'table_number' => 'sometimes|integer|min:1',
            'table_name' => 'nullable|string|max:100',
            'max_capacity' => 'sometimes|integer|min:1',
        ]);

        $weddingTable->update($validated);
        return response()->json($weddingTable);
    }

    public function destroy(WeddingTable $weddingTable)
    {
        $weddingTable->delete();
        return response()->json(['message' => 'Wedding table deleted successfully']);
    }
}
