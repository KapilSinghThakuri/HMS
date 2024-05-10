<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Department;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function __construct(Department $department)
    {
        $this->department = $department;
    }

    public function index()
    {
        $doctors = Doctor::with('educations')->orderBy('created_at','desc')->get();
        $patients = Patient::with('appointment')->orderBy('created_at','desc')->get();
        $appointments = Appointment::all();
        $departments = Department::all();
        return view('admin_Panel.index',compact('doctors','patients','appointments','departments'));
    }

    public function doctorBarChart(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $departmentId = $request->input('department_id');

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'department_id' => 'required|integer'
        ],
        [
            'end_date.after_or_equal' => 'Please ensure the end date is the same date or later than the start date.',
        ]);

        $department = Department::find($request->department_id);
        $doctorsWithAppointments = $department->doctors()
            ->with(['appointments' => function($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }])
            ->get();

        $doctorLabels = [];
        $appointmentCount = [];
        foreach ($doctorsWithAppointments as $doctor) {
            $doctorLabels[] = $doctor->first_name;
            $appointmentCount[] = $doctor->appointments->count();
        }

        // dd($doctorLabels, $appointmentCount);

        session([
            'departmentId' => $department,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'labels' => $doctorLabels,
            'patientCountDatasets' => $appointmentCount,
        ]);

        return redirect()->route('admin.dashboard');
    }

    public function departmentChart(Request $request)
    {
        $startDate = $request->input('search_start_date');
        $endDate = $request->input('search_end_date');

        $request->validate([
            'search_start_date' => 'required|date',
            'search_end_date' => 'required|date|after_or_equal:search_start_date',
        ],
        [
            'search_end_date.after_or_equal' => 'Please ensure the end date is the same date or later than the start date.',
        ]);

        // Get all departments with their doctors and filtered appointment count by given time interval
        $departments = Department::with(['doctors' => function ($query) use ($startDate, $endDate) {
            $query->with(['appointments' => function ($subQuery) use ($startDate, $endDate) {
                $subQuery->whereBetween('created_at', [$startDate, $endDate]);
            }]);
        }])->get();

        $department_appointment_counts = [];
        $department_name = [];
        foreach ($departments as $department) {
            $total_appointments = 0;
            foreach ($department->doctors as $doctor) {
                $total_appointments += $doctor->appointments->count();
            }

            $department_appointment_counts[] = $total_appointments;
            $department_name[] = $department->department_name;
        }
        // dd($department_appointment_counts, $department_name);

        session([
            'deptStartDate' => $startDate,
            'deptEndDate' => $endDate,
            'departmentLabels' => $department_name,
            'deptAppointmentCountDatasets' => $department_appointment_counts,
        ]);

        return redirect()->route('admin.dashboard');
    }
}
