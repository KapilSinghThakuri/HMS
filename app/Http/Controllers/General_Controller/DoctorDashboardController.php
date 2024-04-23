<?php

namespace App\Http\Controllers\General_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Education;
use App\Models\Experience;
use App\Models\User;
use App\Models\Address;
use App\Models\Country;
use App\Models\District;
use App\Models\Province;
use App\Models\Municipality;
use App\Models\Schedule;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PatientNotification;

class DoctorDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $doctor = $user->doctor;
        $doctorId = $doctor->id;
        $appointments = $doctor->appointments;

        $pendingAppointmentsCount = 0;
        foreach ($appointments as $appointment) {
            if ($appointment->status === 'pending') {
                $pendingAppointmentsCount++;
            }
        }
        $approvedAppointmentsCount = 0;
        foreach ($appointments as $appointment) {
            if ($appointment->status === 'approved') {
                $approvedAppointmentsCount++;
            }
        }
        $cancelledAppointmentsCount = 0;
        foreach ($appointments as $appointment) {
            if ($appointment->status === 'cancelled') {
                $cancelledAppointmentsCount++;
            }
        }

        return view('general_dashboard.doctor_dashboard.index',compact('appointments','doctor','pendingAppointmentsCount','approvedAppointmentsCount','cancelledAppointmentsCount'));
    }

    public function approveAppointment(Request $request, $appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $data['status'] = 'approved';
        $appointment->update($data);

        $patient = $appointment->patient;
        $schedule = $appointment->schedule;
        Notification::send($patient, new PatientNotification($patient,'appointment_approved', $appointment, $schedule));

        return back()->with('message','Appointment approved successfully !!!');
    }
    public function cancelAppointment(Request $request, $appointmentId)
    {
        $appointment = Appointment::findOrFail($appointmentId);
        $data['status'] = 'cancelled';
        $appointment->update($data);

        $patient = $appointment->patient;
        $schedule = $appointment->schedule;
        Notification::send($patient, new PatientNotification($patient,'appointment_cancelled', $appointment, $schedule ));

        return back()->with('message','Appointment cancelled successfully !!!');
    }
}
