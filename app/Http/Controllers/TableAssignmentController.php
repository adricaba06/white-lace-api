<?php

namespace App\Http\Controllers;

use App\Models\TableAssignment;
use Illuminate\Http\Request;

class TableAssignmentController extends Controller
{
    public function index()
    {
        return response()->json(TableAssignment::all());
    }

    public function getTableMembers($tableId)
    {
        return response()->json(
            TableAssignment::where('wedding_table_id', $tableId)->get()
        );
    }

    public function getTableAssignationByUserId($weddingMemberId)
    {
        return response()->json(
            TableAssignment::where('wedding_member_id', $weddingMemberId)->get()
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'wedding_member_id' => 'required|exists:wedding_members,id',
            'wedding_table_id' => 'required|exists:wedding_tables,id',
        ]);

        $assignment = TableAssignment::create($validated);
        return response()->json($assignment, 201);
    }

    public function show(TableAssignment $tableAssignment)
    {
        return response()->json($tableAssignment);
    }

    public function update(Request $request, TableAssignment $tableAssignment)
    {
        $validated = $request->validate([
            'wedding_member_id' => 'sometimes|exists:wedding_members,id',
            'wedding_table_id' => 'sometimes|exists:wedding_tables,id',
        ]);

        $tableAssignment->update($validated);
        return response()->json($tableAssignment);
    }

    public function destroy(TableAssignment $tableAssignment)
    {
        $tableAssignment->delete();
        return response()->json(['message' => 'Table assignment deleted successfully']);
    }
}
