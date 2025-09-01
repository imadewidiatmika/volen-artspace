<?php
// app/Models/Activity.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Activity extends Model
{
    use HasFactory;

    // Konfigurasi khusus untuk Primary Key UUID
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
    ];

    /**
     * Boot the model.
     * Otomatis membuat UUID saat data baru dibuat.
     */
    protected static function booted(): void
    {
        static::creating(function (Activity $activity) {
            $activity->id = (string) Str::uuid();
        });
    }
}