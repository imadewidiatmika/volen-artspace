<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
       protected $fillable = [
        'activities',
        'date',
        'time',
        'location',
        'schedule_id', 
    ];

     protected $casts = [
        'date' => 'date',
    ];

    // Relationship dengan activity schedule
    public function activitySchedule()
    {
        return $this->belongsTo(ActivitySchedule::class, 'schedule_id');
    }
}
