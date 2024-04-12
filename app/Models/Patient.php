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
}
