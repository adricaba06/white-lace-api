<?php

namespace App\Http\Controllers;

use App\Models\WeddingMember;
use Illuminate\Http\Request;

class WeddingMemberController extends Controller
{
    // Listar todos los miembros
    public function index()
    {
        return response()->json(WeddingMember::all());
    }

    // Crear un nuevo miembro
    public function store(Request $request)
    {
        $validated = $request->validate([
            'wedding_id' => 'required|exists:weddings,id',
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:couple,collaborator,guest',
            'status' => 'required|string',
            'profile_picture_url' => 'nullable|url|max:255',
        ]);

        $member = WeddingMember::create($validated);

        return response()->json($member, 201);
    }

    // Mostrar un miembro específico
    public function show(WeddingMember $weddingMember)
    {
        return response()->json($weddingMember);
    }

    // Actualizar un miembro existente
    public function update(Request $request, WeddingMember $weddingMember)
    {
        $validated = $request->validate([
            'role' => 'in:couple,collaborator,guest',
            'status' => 'string',
            'profile_picture_url' => 'nullable|url|max:255',
        ]);

        $weddingMember->update($validated);
        $weddingMember->refresh(); // asegura que devuelva los datos actualizados

        return response()->json($weddingMember, 200);
    }

    
    public function destroy(WeddingMember $weddingMember)
    {
        $weddingMember->delete();
        return response()->json(['message' => 'Wedding member deleted successfully'], 200);
    }

    public function getMembers($weddingId)
    {
        $members = WeddingMember::where('wedding_id', $weddingId)->get();

        return response()->json($members, 200);
    }

    public function getTableMembers($tableId)
        {
            return response()->json(
                TableAssignment::where('wedding_table_id', $tableId)->get()
            );
        }

}
