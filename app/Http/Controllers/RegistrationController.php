<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivitySchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse; // <-- PERBAIKAN 1: Tambahkan ini

class RegistrationController extends Controller
{
    // ... (method showStep1, getDates, getTimes Anda tidak berubah) ...
    public function showStep1(): View
    {
        $availableActivityIds = ActivitySchedule::where('status', 'Open Registration')
            ->whereDate('date', '>=', today())
            ->distinct()
            ->pluck('activity_id');
        
        $activities = Activity::whereIn('id', $availableActivityIds)
            ->orderBy('name')
            ->get();

        return view('registration.registration', compact('activities'));
    }

    public function getDates(Request $request)
    {
        $request->validate(['activity_id' => 'required|uuid|exists:activities,id']);

        $dates = ActivitySchedule::where('activity_id', $request->activity_id)
            ->where('status', 'Open Registration')
            ->whereDate('date', '>=', today())
            ->distinct()
            ->orderBy('date')
            ->pluck('date');

        $formattedDates = $dates->map(function ($date) {
            return [
                'value' => $date,
                'text' => Carbon::parse($date)->format('d F Y')
            ];
        });

        return response()->json($formattedDates);
    }

    public function getTimes(Request $request)
    {
        $request->validate([
            'activity_id' => 'required|uuid|exists:activities,id',
            'date' => 'required|date',
        ]);

        $schedules = ActivitySchedule::where('activity_id', $request->activity_id)
            ->where('date', $request->date)
            ->where('status', 'Open Registration')
            ->orderBy('time')
            ->get(['id', 'time', 'location', 'price']);

        $formattedTimes = $schedules->map(function ($schedule) {
            return [
                'schedule_id' => $schedule->id,
                'time_text' => Carbon::parse($schedule->time)->format('H:i'),
                'location' => $schedule->location,
                'price' => number_format($schedule->price, 0, ',', '.')
            ];
        });

        return response()->json($formattedTimes);
    }

    /**
     * Menampilkan halaman registrasi langkah kedua.
     */
    // PERBAIKAN 2: Ubah return type menjadi union type
    public function showStep2(ActivitySchedule $schedule): View|RedirectResponse
    {
        if (!$schedule->isAvailable()) {
            return redirect()->route('registration')
                ->with('error', 'Maaf, jadwal yang dipilih sudah tidak tersedia.');
        }

        session(['registration_schedule' => $schedule]);

        return view('registration.registration2', compact('schedule'));
    }

    /**
     * Memvalidasi dan menyimpan data pengguna dari langkah kedua ke session.
     */
    public function storeStep2(Request $request)
    {
        $schedule = session('registration_schedule');
        if (!$schedule) {
            return redirect()->route('registration');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'country_code' => 'required|string',
            'whatsapp' => 'required|numeric|min:8',
        ]);
        
        $validated['full_whatsapp'] = $validated['country_code'] . $validated['whatsapp'];

        session(['registration_user_data' => $validated]);

        return redirect()->route('registration.step3');
    }
}