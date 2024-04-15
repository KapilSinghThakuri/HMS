<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\CarbonPeriod;
use Carbon\Carbon;

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

    protected $dates = ['from', 'to'];
    public function getTimeIntervalsAttribute()
    {
        $timeIntervals = [];

        // Generate time intervals with 30-minute increments
        $period = CarbonPeriod::create($this->from, '30 minutes', $this->to->subMinutes(30));

        // Format the time intervals
        foreach ($period as $interval) {
            $endTime = $interval->copy()->addMinutes(30);
            $timeIntervals[] = $interval->format('h:i A') . ' - ' . $endTime->format('h:i A');
        }
        return $timeIntervals;
    }

    public function getInAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('Y-m-d, l');
    }
    // public function getFromAttribute($value)
    // {
    //     return \Carbon\Carbon::createFromFormat('H:i:s', $value)->format('H:i A');
    // }
    // public function getToAttribute($value)
    // {
    //     return \Carbon\Carbon::createFromFormat('H:i:s', $value)->format('H:i A');
    // }
}
