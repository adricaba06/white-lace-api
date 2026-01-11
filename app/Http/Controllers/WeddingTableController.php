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
            'wedding_id' => 'required|integer|exists:weddings,id',
            'table_name' => 'required|string|max:255',
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
            'wedding_id' => 'required|integer|exists:weddings,id',
            'table_name' => 'required|string|max:255',
            'max_capacity' => 'required|integer|min:1',
        ]);

        $weddingTable->update($validated);
        return response()->json($weddingTable);
    }

    public function destroy(WeddingTable $weddingTable)
    {
        $weddingTable->assignments()->delete();
        $weddingTable->delete();
        return response()->json(['message' => 'Wedding table deleted successfully']);
    }

   public function getTables($weddingId)
    {
        try {
            $tables = WeddingTable::where('wedding_id', $weddingId)->get();
            
            return response()->json([
                'success' => true,
                'data' => $tables 
            ]);
        } catch (\Exception $e) {
            Log::error('Error obteniendo mesas: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener las mesas',
                'data' => []
            ], 500);
        }
    }

    
    //yo hice relaciones  para facilitar cosas en agngular y no traerme una cantidad inmensa de datos hice este metodo el cual me trae a aquellos usuarios que no tienen asignada una mesa


    
}
