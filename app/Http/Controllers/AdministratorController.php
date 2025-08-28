<?php
// app/Http/Controllers/AdministratorController.php

namespace App\Http\Controllers;

use App\Models\Administrator;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AdministratorController extends Controller
{
    public function index(Request $request): View
    {
        $query = Administrator::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('username', 'like', "%{$search}%")
                  ->orWhere('identity_number', 'like', "%{$search}%")
                   ->orWhere('address', 'like', "%{$search}%");
        }

        $perPage = $request->get('per_page', 15);
        $administrators = $query->orderBy('username')->paginate($perPage);

        return view('admin.userActivities.administration', compact('administrators'));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'identity_number' => 'required|string|max:255|unique:administrators,identity_number',
            'password' => ['required', 'confirmed', Password::min(8)],
            'is_active' => 'required|boolean',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:20',
        ]);

        Administrator::create($validated);

        return response()->json(['success' => 'Administrator berhasil ditambahkan!']);
    }

    public function edit(Administrator $administrator): JsonResponse
    {
        return response()->json($administrator);
    }

    public function update(Request $request, Administrator $administrator): JsonResponse
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'identity_number' => 'required|string|max:255|unique:administrators,identity_number,' . $administrator->id,
            'password' => ['nullable', 'confirmed', Password::min(8)],
            'is_active' => 'required|boolean',
            'address' => 'nullable|string',
            'phone_number' => 'nullable|string|max:20',
        ]);

        // Hanya update password jika diisi
        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $administrator->update($validated);

        return response()->json(['success' => 'Data administrator berhasil diperbarui!']);
    }

    public function destroy(Administrator $administrator): JsonResponse
    {
        // Tambahkan logika untuk tidak bisa menghapus diri sendiri jika perlu
        // if ($administrator->id === auth()->id()) {
        //     return response()->json(['error' => 'Anda tidak bisa menghapus akun sendiri.'], 422);
        // }
        
        $administrator->delete();
        return response()->json(['success' => 'Administrator berhasil dihapus!']);
    }
}