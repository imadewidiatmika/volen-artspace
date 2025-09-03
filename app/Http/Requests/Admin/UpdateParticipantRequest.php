<?php
namespace App\Http\Requests\Admin;
use Illuminate\Foundation\Http\FormRequest;

class UpdateParticipantRequest extends FormRequest {
    public function authorize(): bool { return true; }
    public function rules(): array {
        $participantId = $this->route('participant')->id;
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:participants,email,' . $participantId,
            'phone' => 'nullable|string|max:20',
            'country' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:1000',
            'province' => 'nullable|string|max:100',
        ];
    }
}