<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctors';
    protected $fillable = [
        'user_id',
        'department_id',
        'first_name',
        'middle_name',
        'last_name',
        'profile',
        'gender',
        'date_of_birth_BS',
        'date_of_birth_AD',
        'email',
        'phone',
        'country_id' ,
        'province_id',
        'district_id',
        'province_id' ,
        'municipality_id' ,
        'street',
        'temp_country_id',
        'temp_province_id',
        'temp_district_id',
        'temp_municipality_id',
        'temp_street',
    ];

    public function departments()
    {
        return $this->belongsTo(Department::class,'department_id','id');
    }
    public function educations()
    {
        return $this->hasMany(Education::class,'doctor_id','id');
    }
    public function experiences()
    {
        return $this->hasMany(Experience::class,'doctor_id','id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
    public function province()
    {
        return $this->belongsTo(Province::class,'province_id','id');
    }
    public function district()
    {
        return $this->belongsTo(District::class,'district_id','id');
    }
    public function municipality()
    {
        return $this->belongsTo(Municipality::class,'municipality_id','id');
    }
}
