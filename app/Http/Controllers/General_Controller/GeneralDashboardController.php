<?php

namespace App\Http\Controllers\General_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AppointmentRequest;
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


class GeneralDashboardController extends Controller
{
    public function index()
    {
        $departments = Department::all();

        $dept_related_doctor = Department::with('doctors')->first();
        $first_dept_doctors = $dept_related_doctor->doctors;
        $doctors = Doctor::all();
        $schedules = Schedule::all();
        return view('general_dashboard.index',compact('departments','doctors','first_dept_doctors','schedules'));
    }

    // public function getDoctorsByDepartment($departmentId)
    // {
    //     $department = Department::findOrFail($departmentId);
    //     $doctors = $department->doctors;

    //     $output = '';
    //     foreach ($doctors as $doctor) {
    //         $output .= '<div class="col-md-4">';
    //         $output .= '<div class="card bg-primary profile-card" data-doctor-id="' . $doctor->id . '" style="cursor: pointer;">';
    //         $output .= '<div class="profile-img">';
    //         $output .= '<img src="' . asset($doctor->profile) . '" alt="Profile Image">';
    //         $output .= '</div>';
    //         $output .= '<div class="profile-details">';
    //         $output .= '<div class="profile-name">' . $doctor->first_name . $doctor->middle_name . ' ' . $doctor->last_name . '</div>';
    //         foreach ($doctor->educations as $education) {
    //             $output .= '<div class="profile-specialization">' . $education->specialization . '</div>';
    //         }
    //         $output .= '</div>';
    //         $output .= '</div>';
    //         $output .= '</div>';
    //     }
    //     return response()->json(['html' => $output]);
    // }

    // public function getSchedulesByDoctor($doctorId)
    // {
    //     $doctor = Doctor::findOrFail($doctorId);
    //     $appointments = $doctor->appointments;
    //     $schedules = $doctor->schedules;
    //     return response()->json([
    //         'appointments' => $appointments,
    //         'schedules' => $schedules
    //     ]);
    // }

    public function appointment($scheduleId)
    {
        $schedule = Schedule::findOrFail($scheduleId);
        $doctor = $schedule->doctor;
        return view('general_dashboard.appointment-form',compact('scheduleId','doctor'));
    }
    public function appointmentStore(AppointmentRequest $request, $scheduleId)
    {
        $validatedData = $request->validated();
        DB::beginTransaction();
        try {
            $patient = Patient::create($validatedData);
            $validatedData['schedule_id'] = $scheduleId;
            $validatedData['patient_id'] = $patient->id;
            $validatedData['status'] = 'pending';

            if ($request->hasFile('medical_history')) {
                $file = $request->file('medical_history');
                $fileName = time().'.'.$file->getClientOriginalName();
                $file->move(public_path('general_Assets/medical-history'), $fileName);
                $validatedData['medical_history'] = 'general_Assets/medical-history/'. $fileName;
            }
            Appointment::create($validatedData);

            DB::commit();
            return redirect()->route('general.dashboard')->with('message','Your Appointment Send Successfully !!!');
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
}
