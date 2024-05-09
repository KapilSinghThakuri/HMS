<?php

namespace App\Helpers;

use App\Models\Doctor;
use App\Models\Education;


/**
 *
 */
class DoctorHelper
{
    public function __construct(Education $specialization, Doctor $doctor)
    {
        $this->specialization = $specialization;
        $this->doctor = $doctor;
    }
    public function dropdown()
    {
        $doctorSpeciality = $this->specialization->pluck('specialization','specialization');
        return $doctorSpeciality;
    }
    public function doctorDropdown()
    {
        $doctors = $this->doctor->get();
        return $doctors;
    }
}
