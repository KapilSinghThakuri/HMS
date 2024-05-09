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
use Carbon\Carbon;

class DoctorDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $doctor = $user->doctor;
        $doctorId = $doctor->id;

        $currentYear = Carbon::now()->year;

        $data = DB::table('appointments') // Use the correct table name
            ->selectRaw('MONTH(created_at) as month, COUNT(DISTINCT patient_id) as patient_count') // Group by month and count distinct patients
            ->where('doctor_id', $doctorId) // Filter by doctor ID
            ->whereYear('created_at', $currentYear) // Filter by the current year
            ->groupBy('month') // Group by month
            ->orderBy('month', 'asc') // Sort by month
            ->get()
            ->keyBy('month');

        $dataArray = $data->toArray();

        $monthNames = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June',
            7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];

        // Prepare labels and patient counts with default 0 if no data
        $labels = [];
        $patientCounts = [];

        for ($i = 1; $i <= 12; $i++) {
            // dd($data[$i]);
            $labels[] = $monthNames[$i];
            $patientCounts[] = isset($data[$i]) ? $data[$i]->patient_count : 0;
        }
        // dd($labels, $patientCounts);

        // $labels = array_map(function($item) use ($monthNames) {
        //     return $monthNames[$item->month];
        // }, $dataArray);

        // $patientCounts = array_map(function($item) {
        //     return $item->patient_count;
        // }, $dataArray);

        // dd($patientCounts);

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

        return view('general_dashboard.doctor_dashboard.index',
            compact('appointments',
                    'doctor',
                    'pendingAppointmentsCount',
                    'approvedAppointmentsCount',
                    'cancelledAppointmentsCount',

                    'labels',
                    'patientCounts'
                ));
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
