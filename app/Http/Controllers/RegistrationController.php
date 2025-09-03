<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\ActivitySchedule;
use App\Models\Participant;
use App\Models\Registration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class RegistrationController extends Controller
{
    public function showStep1(): View
    {
        $activities = Activity::whereHas('schedules', function ($query) {
            $query->where('status', 'Open Registration')->whereDate('date', '>=', today());
        })->orderBy('name')->get();
        return view('registration.registration', compact('activities'));
    }

    public function getDates(Request $request)
    {
        $validated = $request->validate(['activity_id' => 'required|uuid|exists:activities,id']);
        $dates = ActivitySchedule::where('activity_id', $validated['activity_id'])
            ->where('status', 'Open Registration')->whereDate('date', '>=', today())
            ->distinct()->orderBy('date')->pluck('date');
        return response()->json($dates->map(fn($date) => ['value' => $date, 'text' => Carbon::parse($date)->format('d F Y')]));
    }

    public function getTimes(Request $request)
    {
        $validated = $request->validate(['activity_id' => 'required|uuid|exists:activities,id', 'date' => 'required|date']);
        $schedules = ActivitySchedule::where('activity_id', $validated['activity_id'])
            ->where('date', $validated['date'])->where('status', 'Open Registration')
            ->orderBy('time')->get(['id', 'time', 'location', 'price']);
        return response()->json($schedules->map(fn($schedule) => [
            'schedule_id' => $schedule->id, 'time_text' => Carbon::parse($schedule->time)->format('H:i'),
            'location' => $schedule->location, 'price' => number_format($schedule->price, 0, ',', '.')
        ]));
    }

    public function showStep2(ActivitySchedule $schedule): View|RedirectResponse
    {
        if (!$schedule->isAvailable()) {
            return redirect()->route('registration')->with('error', 'Maaf, jadwal yang dipilih sudah tidak tersedia.');
        }
        session(['registration_schedule' => $schedule]);
        $countries = config('countries.list');
        return view('registration.registration2', compact('schedule', 'countries'));
    }

    public function storeStep2(Request $request): RedirectResponse
    {
        $schedule = session('registration_schedule');
        if (!$schedule) return redirect()->route('registration');

        $validated = $request->validate(['name' => 'required|string|max:255', 'email' => 'required|email|max:255', 'country_code' => 'required|string', 'whatsapp' => 'required|numeric|min:8']);
        
        $participant = Participant::updateOrCreate(
            ['email' => $validated['email']],
            ['name' => $validated['name'], 'phone' => '0' . $validated['whatsapp'], 'country' => $this->getCountryNameFromCode($validated['country_code'])]
        );

        $remark = $this->getParticipantRemark($participant);
        $registration = Registration::create(['participant_id' => $participant->id, 'activity_schedule_id' => $schedule->id, 'prtcp_remark' => $remark]);
        
        session(['registration_id' => $registration->id]);
        session()->forget('registration_schedule');
        return redirect()->route('registration.step3');
    }

    public function showStep3(): View|RedirectResponse
    {
        $registrationId = session('registration_id');
        if (!$registrationId) return redirect()->route('registration');
        $registration = Registration::with(['schedule.activity', 'participant'])->findOrFail($registrationId);
        return view('registration.registration3', compact('registration'));
    }

    public function storeStep3(Request $request): RedirectResponse
    {
        $registrationId = session('registration_id');
        if (!$registrationId) {
            return redirect()->route('registration');
        }

        $registration = Registration::findOrFail($registrationId);

        $request->validate([
            'receipt' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
        ]);

        if ($request->hasFile('receipt')) {
            if ($registration->receipt_path) {
                Storage::disk('public')->delete($registration->receipt_path);
            }
            
            // PERBAIKAN 3: Buat ImageManager secara manual dengan driver GD
            $imageManager = new ImageManager(new Driver());
            
            $image = $request->file('receipt');
            $filename = uniqid('receipt_') . '.' . $image->getClientOriginalExtension();
            
            // Gunakan variabel $imageManager yang baru saja kita buat
            $imageStream = $imageManager->read($image)->toJpeg(75);
            
            Storage::disk('public')->put('receipts/' . $filename, (string) $imageStream);
            
            $registration->update([
                'receipt_path' => 'receipts/' . $filename,
                'status' => 'LISTED',
            ]);
        }
        
        session()->forget(['registration_id']);
        
        return redirect()->route('done');
    }
    
    private function getParticipantRemark(Participant $participant): string
    {
        $count = $participant->registrations()->count();
        return match ($count) { 0 => 'FIRST-TIMER', 1 => 'SECOND-TIMER', 2 => 'THIRD-TIMER', default => ($count + 1) . 'TH-TIMER' };
    }

    // PENYEMPURNAAN: Function ini dibuat sedikit lebih efisien dengan Laravel Collection
    private function getCountryNameFromCode(string $code): string
    {
        $countryMap = collect(config('countries.list', []))
                        ->mapWithKeys(fn($country) => [$country['code'] => $country['name']]);

        return $countryMap->get($code, 'Unknown');
    }
}