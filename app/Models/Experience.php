<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Experience extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'experiences';
    protected $fillable = [
         'doctor_id',
        'license_no',
        'org_name',
        'start_date_BS',
        'start_date_AD',
        'end_date_BS',
        'end_date_AD',
        'job_description',
    ];
}
