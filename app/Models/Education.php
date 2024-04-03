<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'education';
    protected $fillable = [
        'doctor_id',
        'institute_name' ,
        'medical_degree' ,
        'graduation_year_BS',
        'graduation_year_AD',
        'specialization',
    ];
}
