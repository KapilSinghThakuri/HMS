<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table = 'appointments';
    protected $fillable = [
        'doctor_id',
        'schedule_id',
        'patient_id',
        'time_interval',
        'reason',
        'appointment_note',
        'status',
    ];
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
