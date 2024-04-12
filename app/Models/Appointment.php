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
        'reason',
        'appointment_note',
        'status',
    ];
}
