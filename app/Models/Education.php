<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Education extends Model
{
    use HasFactory, SoftDeletes;

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
