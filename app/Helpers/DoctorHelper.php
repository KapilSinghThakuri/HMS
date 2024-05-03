<?php

namespace App\Helpers;

use App\Models\Doctor;
use App\Models\Education;


/**
 *
 */
class DoctorHelper
{
    public function __construct(Education $specialization)
    {
        $this->specialization = $specialization;
    }
    public function dropdown()
    {
        $doctorSpeciality = $this->specialization->pluck('specialization','specialization');
        return $doctorSpeciality;
    }
}
