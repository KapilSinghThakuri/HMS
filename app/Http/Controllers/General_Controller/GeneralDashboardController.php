<?php

namespace App\Http\Controllers\General_Controller;

use Illuminate\Support\Str;
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
use App\Notifications\AppointmentNotification;



class GeneralDashboardController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        // dd(Doctor::findOrFail(49)->educations[0]);
        $dept_related_doctor = Department::with('doctors')->first();
        $first_dept_doctors = $dept_related_doctor->doctors;
        $doctors = Doctor::with('appointments')->get();
        $schedules = Schedule::all();
        $appointments = Appointment::get();
        return view('general_dashboard.index',compact('departments','doctors','first_dept_doctors','schedules','appointments'));
    }


    public function appointment($scheduleId, $timeInterval)
    {
        $schedule = Schedule::findOrFail($scheduleId);
        $doctor = $schedule->doctor;
        return view('general_dashboard.appointment-form',compact('scheduleId','doctor', 'timeInterval'));
    }
    public function appointmentStore(AppointmentRequest $request, $scheduleId)
    {
        $validatedData = $request->validated();

        DB::beginTransaction();
        try {
            if ($request->hasFile('medical_history')) {
                $file = $request->file('medical_history');

                $fileName = time().'.'.$file->getClientOriginalExtension();
                $filePath = 'general_Assets/medical-history/';
                $file->move(public_path($filePath), $fileName);
                $validatedData['medical_history'] = $filePath . $fileName;
            }
            $patient = Patient::create($validatedData);

            $validatedData['schedule_id'] = $scheduleId;
            $validatedData['patient_id'] = $patient->id;
            $validatedData['status'] = 'pending';

            $appointment = Appointment::create($validatedData);

            $admin = User::where('role_id', 1)->first();
            $admin->notify(new AppointmentNotification($appointment, $patient, 'appointment_create'));

            DB::commit();
            return redirect()->route('general.dashboard')->with('message','Your Appointment Send Successfully !!!');
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }
}
