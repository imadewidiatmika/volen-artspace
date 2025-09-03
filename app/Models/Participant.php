<?php
// app/Models/Participant.php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids; // Pastikan ini ada
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Registration;

class Participant extends Model
{
    // GUNAKAN TRAIT HasUuids DI SINI
    use HasFactory, HasUuids;

    protected $fillable = ['name', 'email', 'phone', 'country'];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}