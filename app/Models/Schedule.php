<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'schedules';
    protected $fillable = [
        'doctor_id',
        'in',
        'from',
        'to',
    ];
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function appointment()
    {
        return $this->hasOne(Appointment::class,'schedule_id','id');
    }

    // Using Accessor property for define the date-time format
    public function getInAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d, l');
    }
    public function getFromAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('H:i:s', $value)->format('H:i A');
    }
    public function getToAttribute($value)
    {
        return \Carbon\Carbon::createFromFormat('H:i:s', $value)->format('H:i A');
    }
}
