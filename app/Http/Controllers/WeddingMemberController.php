<?php

namespace App\Http\Controllers;

use App\Models\WeddingMember;
use Illuminate\Http\Request;

class WeddingMemberController extends Controller
{


    public function unassignedByWedding($weddingId)
    {
        $members = WeddingMember::where('wedding_id', $weddingId)
            ->whereDoesntHave('tableAssignments')
            ->get();

        return response()->json($members, 200);
    }


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

    public function getById($id)
    {
        $member = WeddingMember::find($id);

        if (!$member) {
            return response()->json(['message' => 'Miembro no encontrado'], 404);
        }

        return response()->json($member, 200);
    }

    public function getMembersPaginated(Request $request, $weddingId)
    {
        $query = WeddingMember::join('users', 'wedding_members.user_id', '=', 'users.id')
            ->with('user') // Cargamos la relación para el JSON final
            ->where('wedding_members.wedding_id', $weddingId)
            ->whereIn('wedding_members.role', ['guest', 'collaborator']);

        // 1. Búsqueda por Nombre o Apellido (están en la tabla 'users')
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('users.name', 'LIKE', "%{$search}%")
                    ->orWhere('users.surname', 'LIKE', "%{$search}%");
            });
        }

        // 2. Filtro de Niños (usamos tu campo 'children_count')
        if ($request->boolean('has_children')) {
            $query->where('wedding_members.children_count', '>', 0);
        }

        // 3. Filtro de Intolerancias (usamos tu campo 'has_intolerance')
        if ($request->boolean('only_intolerants')) {
            $query->where('wedding_members.has_intolerance', true);
        }

        // 4. Ordenación Alfabética (usando 'name' de la tabla users)
        $sort = $request->input('sort', 'name_asc');
        if ($sort === 'name_asc') {
            $query->orderBy('users.name', 'asc');
        } elseif ($sort === 'name_desc') {
            $query->orderBy('users.name', 'desc');
        }

        return $query->select('wedding_members.*')->paginate(4);
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


    public function getByUserId($userId)
    {
        $weddingMember = WeddingMember::where('user_id', $userId)
            ->with('wedding')
            ->first();

        if (!$weddingMember) {
            return response()->json([
                'message' => 'Wedding member no encontrado'
            ], 404);
        }

        return response()->json($weddingMember);
    }


}
