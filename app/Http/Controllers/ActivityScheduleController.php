<?php
// app/Http/Controllers/ActivityScheduleController.php

namespace App\Http\Controllers;

use App\Models\Activity; // <-- TAMBAHKAN INI
use App\Models\ActivitySchedule;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ActivityScheduleController extends Controller
{
    public function index(Request $request): View
    {
        // Eager load relasi 'activity' untuk efisiensi
        $query = ActivitySchedule::with('activity');

        if ($request->filled('search')) {
            $search = $request->search;
            // Ubah pencarian untuk mencari di nama relasi
            $query->whereHas('activity', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhere('location', 'like', "%{$search}%")
              ->orWhere('status', 'like', "%{$search}%");
        }

        $perPage = $request->get('per_page', 15);
        $schedules = $query->orderBy('date')->orderBy('time')->paginate($perPage);
        
        // Ambil semua data master aktivitas untuk dropdown
        $activities = Activity::orderBy('name')->get();

        return view('admin.scheduleRegistration.activitySchedule', compact('schedules', 'activities'));
    }

    public function store(Request $request): JsonResponse
    {
        // Sesuaikan validasi untuk activity_id
        $validated = $request->validate([
            'activity_id' => 'required|exists:activities,id', // <-- UBAH INI
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'max_participants' => 'required|integer|min:1|max:100',
            'description' => 'nullable|string|max:1000'
        ]);

        // Logika cek konflik jadwal Anda sudah benar
        $existingSchedule = ActivitySchedule::where('date', $validated['date'])
            ->where('time', $validated['time'])
            ->where('location', $validated['location'])
            ->first();

        if ($existingSchedule) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['general' => ['Jadwal konflik! Sudah ada aktivitas pada tanggal, waktu, dan lokasi yang sama.']]
            ], 422);
        }

        ActivitySchedule::create($validated);

        return response()->json(['success' => 'Jadwal aktivitas berhasil dibuat!']);
    }
    
    public function edit(ActivitySchedule $activitySchedule): JsonResponse
    {
        // Ini sudah benar, karena $activitySchedule sudah mengandung activity_id
        return response()->json($activitySchedule);
    }

    public function update(Request $request, ActivitySchedule $activitySchedule): JsonResponse
    {
        // Sesuaikan validasi untuk activity_id
        $validated = $request->validate([
            'activity_id' => 'required|exists:activities,id', // <-- UBAH INI
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'max_participants' => 'required|integer|min:1|max:100',
            'status' => 'required|in:Open Registration,Closed Registration,Completed,Cancelled',
            'description' => 'nullable|string|max:1000'
        ]);

        // Validasi max participants Anda sudah benar
        if ($validated['max_participants'] < $activitySchedule->registered_participants) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['max_participants' => ['Maksimal peserta tidak boleh kurang dari peserta yang sudah terdaftar.']]
            ], 422);
        }

        $activitySchedule->update($validated);

        return response()->json(['success' => 'Jadwal aktivitas berhasil diperbarui!']);
    }

    public function destroy(ActivitySchedule $activitySchedule): JsonResponse
    {
        // Ini sudah benar
        if ($activitySchedule->registered_participants > 0) {
            return response()->json(['error' => 'Tidak dapat menghapus jadwal yang sudah memiliki peserta terdaftar.'], 422);
        }

        $activitySchedule->delete();

        return response()->json(['success' => 'Jadwal aktivitas berhasil dihapus!']);
    }
}