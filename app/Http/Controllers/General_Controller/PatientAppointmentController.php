<?php

namespace App\Http\Controllers\General_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientAppointmentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $doctor = $user->doctor;
        $doctorId = $doctor->id;
        $appointments = $doctor->appointments;
        return view('general_dashboard.doctor_dashboard.appointment.appointments',compact('appointments'));
    }
}
