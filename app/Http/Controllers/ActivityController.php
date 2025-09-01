<?php
// app/Http/Controllers/ActivityController.php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivitySchedule;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ActivityController extends Controller
{
    public function index(Request $request): View
    {
        $query = Activity::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        $perPage = $request->get('per_page', 15);
        $activities = $query->orderBy('name')->paginate($perPage);

        return view('admin.userActivities.activitiesDatabase', compact('activities'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:activities,name',
        ]);

        Activity::create($validated);

        return response()->json(['success' => 'Aktivitas baru berhasil ditambahkan!']);
    }

    public function edit(Activity $activity): JsonResponse
    {
        return response()->json($activity);
    }

    public function update(Request $request, Activity $activity): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:activities,name,' . $activity->id,
        ]);

        $activity->update($validated);

        return response()->json(['success' => 'Aktivitas berhasil diperbarui!']);
    }
    
   public function destroy(Activity $activity): JsonResponse
    {
        // PERBAIKI LOGIKA INI:
        // Cek apakah aktivitas sedang digunakan menggunakan relasi.
        if ($activity->schedules()->exists()) {
            return response()->json(['error' => 'Aktivitas tidak bisa dihapus karena sedang digunakan di dalam jadwal.'], 422);
        }

        $activity->delete();
        return response()->json(['success' => 'Aktivitas berhasil dihapus!']);
    }
}