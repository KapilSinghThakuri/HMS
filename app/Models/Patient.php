<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table = 'patients';
    protected $fillable = [
        'fullname',
        'gender',
        'date_of_birth',
        'temporary_address',
        'permanent_address',
        'phone',
        'email',
        'parents_name',
        'appointment_message',
        'medical_history',
    ];

    // Specifying that date_of_birth should be treated as a date
    protected $dates = ['date_of_birth'];
    public function getAgeAttribute()
    {
        return $this->date_of_birth->diffInYears(now());
    }
    public function appointment()
    {
        return $this->hasOne(Appointment::class,'patient_id','id');
    }
}
