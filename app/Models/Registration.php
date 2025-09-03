<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $fillable = ['participant_id', 'activity_schedule_id', 'prtcp_remark', 'status','receipt_path',];

    public function participant() {
        return $this->belongsTo(Participant::class);
    }

    public function schedule() {
        return $this->belongsTo(ActivitySchedule::class, 'activity_schedule_id');
    }
}