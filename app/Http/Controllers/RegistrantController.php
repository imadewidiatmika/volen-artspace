<?php

namespace App\Http\Controllers; 

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivitySchedule;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View; 
use Illuminate\Http\JsonResponse; 

class RegistrantController extends Controller
{
    public function index(): View
    {
        $activities = Activity::whereHas('registrations')->orderBy('name')->get();
        return view('admin.scheduleRegistration.registrants', compact('activities'));
    }

    public function getDates(Request $request): JsonResponse
    {
        $validated = $request->validate(['activity_id' => 'required|uuid|exists:activities,id']);
        $dates = ActivitySchedule::where('activity_id', $validated['activity_id'])
            ->whereHas('registrations')->distinct()->orderBy('date')->pluck('date');
        return response()->json($dates->map(fn($date) => [
            'value' => $date, 'text' => Carbon::parse($date)->format('l, d/m/Y')
        ]));
    }

    public function getTimes(Request $request): JsonResponse
    {
        $validated = $request->validate(['activity_id' => 'required|uuid|exists:activities,id', 'date' => 'required|date']);
        $schedules = ActivitySchedule::where('activity_id', $validated['activity_id'])
            ->where('date', $validated['date'])->whereHas('registrations')
            ->orderBy('time')->get();
        return response()->json($schedules->map(fn($schedule) => [
            'id' => $schedule->id, 'time' => Carbon::parse($schedule->time)->format('H:i \W\I\T\A'),
            'location' => $schedule->location, 'status' => $schedule->status
        ]));
    }

    public function getRegistrants(Request $request): JsonResponse
    {
        $validated = $request->validate(['schedule_id' => 'required|exists:activity_schedules,id']);
        $search = $request->input('search');
        $perPage = $request->input('per_page', 15);

        $registrationsPaginator = Registration::with(['participant'])
            ->where('activity_schedule_id', $validated['schedule_id'])
            ->whereHas('participant')
            ->when($search, function ($query, $search) {
                $query->whereHas('participant', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()->paginate($perPage);

        $registrationsPaginator->through(function ($reg) {
            return [
                'participant_id' => $reg->participant->id,
                'name' => $reg->participant->name,
                'phone' => $reg->participant->phone,
                'email' => $reg->participant->email,
                'country' => $reg->participant->country,
                'remark' => $reg->prtcp_remark,
                'receipt_url' => $reg->receipt_path ? asset('storage/' . $reg->receipt_path) : null,
                'status' => $reg->status
            ];
        });

        return response()->json($registrationsPaginator);
    }
}