<?php

namespace App\Http\Controllers\Website;

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
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\App;
use App\Models\DynamicPage;


class GeneralDashboardController extends Controller
{
    public function __construct(DynamicPage $pages)
    {
        $this->pages = $pages;
    }

    public function index()
    {
        // dd(session()->all());
        $langValue = session('locale');

        $departments = Department::all();
        // dd(Doctor::findOrFail(49)->educations[0]);
        $dept_related_doctor = Department::with('doctors')->first();
        $first_dept_doctors = $dept_related_doctor->doctors;
        $doctors = Doctor::with('appointments')->get();
        $schedules = Schedule::all();
        $appointments = Appointment::get();

        $pages = $this->pages->get();
        // dd($pages);
        return view('website.index',
            compact(
                'departments',
                'doctors',
                'first_dept_doctors',
                'schedules',
                'appointments',
                'langValue',
                'pages'
            ));
    }


    public function appointment($scheduleId, $timeInterval)
    {
        $schedule = Schedule::findOrFail($scheduleId);
        $doctor = $schedule->doctor;
        return view('website.appointment.appointment-form',compact('scheduleId','doctor', 'timeInterval'));
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

            $users = User::role(['Super Admin', 'Administrator'])->get();
            foreach ($users as $user) {
                $user->notify(new AppointmentNotification($appointment, $patient, 'appointment_create'));
            }

            DB::commit();
            return redirect()->route('general.dashboard')->with('message','Your Appointment Send Successfully !!!');
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function setLocale($locale)
    {

        App::setLocale($locale);

        session()->put('locale', $locale);

        // return redirect()->back();
        return redirect()->route('general.dashboard',compact('locale'));
    }
}
