<?php

namespace App\Http\Controllers; 

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreParticipantRequest;
use App\Http\Requests\Admin\UpdateParticipantRequest;
use App\Models\Participant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ParticipantController extends Controller
{
    public function index(Request $request): View
    {
        $query = Participant::latest();
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(fn($q) => 
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
            );
        }
        $perPage = $request->get('per_page', 15);
        $participants = $query->paginate($perPage)->withQueryString();
        return view('admin.participants.participants', compact('participants'));
    }

    public function store(StoreParticipantRequest $request): JsonResponse
    {
        Participant::create($request->validated());
        return response()->json(['success' => 'Participant created successfully.']);
    }

    public function edit(Participant $participant): JsonResponse
    {
        return response()->json($participant);
    }

    public function update(UpdateParticipantRequest $request, Participant $participant): JsonResponse
    {
        $participant->update($request->validated());
        return response()->json(['success' => 'Participant updated successfully.']);
    }

    public function destroy(Participant $participant): JsonResponse
    {
        if ($participant->registrations()->exists()) {
            return response()->json(['error' => 'Cannot delete a participant who has registrations.'], 422);
        }
        $participant->delete();
        return response()->json(['success' => 'Participant deleted successfully.']);
    }
}