<?php
// app/Models/Activity.php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids; // <-- Gunakan ini
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    // Trait HasUuids ini menggantikan semua kode manual Anda untuk UUID
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
    ];

    /**
     * Relasi bahwa satu Activity bisa memiliki banyak jadwal.
     */
    public function schedules()
    {
        return $this->hasMany(ActivitySchedule::class);
    }

    /**
     * FUNGSI INI MEMPERBAIKI ERROR ANDA
     * Relasi bahwa satu Activity memiliki banyak pendaftaran (melalui jadwal).
     */
    public function registrations()
    {
        return $this->hasManyThrough(Registration::class, ActivitySchedule::class);
    }
}