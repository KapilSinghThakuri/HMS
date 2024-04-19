<?php

namespace App\Http\Controllers\General_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;

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

    public function show($appointmentId)
    {
        $appointments = Appointment::where('id', $appointmentId)->first();
        return view('general_dashboard.doctor_dashboard.appointment.view-appointment',compact('appointments'));
    }

    public function patientsIndex()
    {
        $user = Auth::user();
        $doctor = $user->doctor;
        $appointments = $doctor->appointments;
        return view('general_dashboard.doctor_dashboard.patient.patients',compact('appointments'));
    }
}
