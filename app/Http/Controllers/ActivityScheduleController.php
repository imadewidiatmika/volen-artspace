<?php

namespace App\Http\Controllers;

use App\Models\ActivitySchedule;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class ActivityScheduleController extends Controller
{
    /**
     * Menampilkan halaman utama dengan tabel data jadwal.
     */
    public function index(Request $request): View
    {
        $query = ActivitySchedule::query();

        // Logika untuk fungsionalitas pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('activity', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%");
            });
        }

        $perPage = $request->get('per_page', 15);
        $schedules = $query->orderBy('date')->orderBy('time')->paginate($perPage);
        
        return view('admin.scheduleRegistration.activitySchedule', compact('schedules'));
    }

    /**
     * Menyimpan jadwal baru yang dikirim via AJAX.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|date_format:H:i',
            'activity' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'max_participants' => 'required|integer|min:1|max:100',
            'description' => 'nullable|string|max:1000'
        ]);

        // Cek jika ada jadwal yang konflik
        $existingSchedule = ActivitySchedule::where('date', $validated['date'])
            ->where('time', $validated['time'])
            ->where('location', $validated['location'])
            ->first();

        if ($existingSchedule) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['activity' => ['Jadwal konflik! Sudah ada aktivitas pada tanggal, waktu, dan lokasi yang sama.']]
            ], 422);
        }

        ActivitySchedule::create($validated);

        return response()->json(['success' => 'Jadwal aktivitas berhasil dibuat!']);
    }
    
    /**
     * Mengambil data satu jadwal untuk ditampilkan di modal edit.
     */
    public function edit(ActivitySchedule $activitySchedule): JsonResponse
    {
        return response()->json($activitySchedule);
    }

    /**
     * Memperbarui data jadwal yang dikirim via AJAX.
     */
    public function update(Request $request, ActivitySchedule $activitySchedule): JsonResponse
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'activity' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'max_participants' => 'required|integer|min:1|max:100',
            'status' => 'nullable|in:Open Registration,Closed Registration,Completed,Cancelled',
            'description' => 'nullable|string|max:1000'
        ]);

        // Validasi max participants tidak kurang dari registered
        if ($validated['max_participants'] < $activitySchedule->registered_participants) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['max_participants' => ['Maksimal peserta tidak boleh kurang dari peserta yang sudah terdaftar.']]
            ], 422);
        }

        $activitySchedule->update($validated);

        return response()->json(['success' => 'Jadwal aktivitas berhasil diperbarui!']);
    }

    /**
     * Menghapus data jadwal via AJAX.
     */
    public function destroy(ActivitySchedule $activitySchedule): JsonResponse
    {
        if ($activitySchedule->registered_participants > 0) {
            return response()->json(['error' => 'Tidak dapat menghapus jadwal yang sudah memiliki peserta terdaftar.'], 422);
        }

        $activitySchedule->delete();

        return response()->json(['success' => 'Jadwal aktivitas berhasil dihapus!']);
    }
}