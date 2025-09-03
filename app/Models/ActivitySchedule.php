<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Registration;

class ActivitySchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time',
        'activity_id', // <-- Ganti ini
        'location',
        'price',
        'max_participants',
        'description',
        'status' // tambahkan properti lain jika ada
    ];

    // Tambahkan relasi ini
    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
    
    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i',
        'price' => 'decimal:2'
    ];

    // Relationship dengan registrations
public function registrations() {
    return $this->hasMany(Registration::class, 'activity_schedule_id');
}
    // Accessor untuk format tanggal Indonesia
    public function getFormattedDateAttribute()
    {
        return $this->date->format('l, d/m/Y');
    }

    // Accessor untuk format waktu
    public function getFormattedTimeAttribute()
    {
        return Carbon::parse($this->time)->format('H.i') . ' WITA';
    }

    // Accessor untuk format harga
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 0, ',', '.');
    }

    // Method untuk cek ketersediaan
    public function isAvailable()
    {
        return $this->status === 'Open Registration' && $this->registered_participants < $this->max_participants;
    }

    // Method untuk menambah peserta
    public function addParticipant()
    {
        $this->increment('registered_participants');
        
        // Auto close jika sudah penuh
        if ($this->registered_participants >= $this->max_participants) {
            $this->update(['status' => 'Closed Registration']);
        }
    }

    // Method untuk mengurangi peserta (jika dibatalkan)
    public function removeParticipant()
    {
        if ($this->registered_participants > 0) {
            $this->decrement('registered_participants');
            
            // Auto open jika ada slot kosong
            if ($this->status === 'Closed Registration' && $this->registered_participants < $this->max_participants) {
                $this->update(['status' => 'Open Registration']);
            }
        }
    }

    // Scope untuk status tertentu
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Scope untuk jadwal yang akan datang
    public function scopeUpcoming($query)
    {
        return $query->where('date', '>=', Carbon::today());
    }

    // Scope untuk hari ini
    public function scopeToday($query)
    {
        return $query->whereDate('date', Carbon::today());
    }

    public function registration()
{
    return $this->hasMany(Registration::class, 'activity_schedule_id');
}
}