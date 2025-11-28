<?php

namespace App\Http\Controllers;

use App\Models\WeddingMember;
use Illuminate\Http\Request;

class WeddingMemberController extends Controller
{
    public function index()
    {
        return response()->json(WeddingMember::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'wedding_id' => 'required|exists:weddings,id',
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:couple,collaborator,guest',
            'invitation_status' => 'in:pending,sent,viewed',
            'rsvp_status' => 'in:pending,confirmed,declined',
            'number_of_companions' => 'integer|min:0',
            'dietary_restrictions' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
        ]);

        $member = WeddingMember::create($validated);
        return response()->json($member, 201);
    }

    public function show(WeddingMember $weddingMember)
    {
        return response()->json($weddingMember);
    }

    public function update(Request $request, WeddingMember $weddingMember)
    {
        $validated = $request->validate([
            'role' => 'in:couple,collaborator,guest',
            'invitation_status' => 'in:pending,sent,viewed',
            'rsvp_status' => 'in:pending,confirmed,declined',
            'number_of_companions' => 'integer|min:0',
            'dietary_restrictions' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
        ]);

        $weddingMember->update($validated);
        return response()->json($weddingMember);
    }

    public function destroy(WeddingMember $weddingMember)
    {
        $weddingMember->delete();
        return response()->json(['message' => 'Wedding member deleted successfully']);
    }
}
