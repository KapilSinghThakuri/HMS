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
    public function index()
    {
        $doctors = Doctor::with('educations')->orderBy('created_at','desc')->get();
        // whereBetween('column', [$start, $end]) use for Date, Numeric, Alphabetic Ranges
        foreach ($doctors as $doctor) {
            $patientCount = $doctor->patients
                ->whereBetween('created_at', ['2024-04-20 10:04:24','2024-05-09 03:06:49'])
                ->count();
            // dd($patientCount);
        }


        $patients = Patient::with('appointment')->orderBy('created_at','desc')->get();
        $appointments = Appointment::all();
        $departments = Department::all();
        return view('admin_Panel.index',compact('doctors','patients','appointments','departments'));
    }

    public function doctorBarChart(Request $request)
    {
        $currentYear = Carbon::now()->year;

        if (isset($request->department_id)) {
            $department = Department::find($request->department_id);
            $doctorIds = $department->doctors()->pluck('id');

            $deptWisePatient = Appointment::selectRaw('MONTH(created_at) as month, COUNT(*) as depts_patient_count') // Group by month and count department wise patients
                ->whereIn('doctor_id', $doctorIds) // Filter by list of doctors in the specific department
                ->whereYear('created_at', $currentYear) // Filter by the current year
                ->groupBy('month') // Group by month
                ->orderBy('month', 'asc') // Sort by month
                ->get()
                ->keyBy('month');

            // dd($deptWisePatient);
        }


        if (isset($request->doctor_id)) {
            $doctorId = $request->doctor_id;
            $doctorWisePatient = Appointment::selectRaw('MONTH(created_at) as month, COUNT(DISTINCT patient_id) as doctors_patient_count') // Group by month and count doctor wise distinct patients
                ->where('doctor_id', $doctorId) // Filter by doctor ID
                ->whereYear('created_at', $currentYear)
                ->groupBy('month')
                ->orderBy('month', 'asc')
                ->get()
                ->keyBy('month');
            // dd($doctorWisePatient);
        }

        $monthNames = [
            1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June',
            7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'
        ];

        $labels = [];
        $doctorPatientCounts = [];
        $deptWisePatientCounts = [];
        for ($i = 1; $i <= 12; $i++) {
            // dd($doctorWisePatient[$i]);
            $labels[] = $monthNames[$i];
            $doctorPatientCounts[] = isset($doctorWisePatient[$i]) ? $doctorWisePatient[$i]->doctors_patient_count : 0;
            $deptPatientCounts[] = isset($deptWisePatient[$i]) ? $deptWisePatient[$i]->depts_patient_count : 0;
        }
        // dd($deptPatientCounts);

        session([
            'labels' => $labels,
            'doctorId' => $doctorId,
            'doctorPatientCounts' => $doctorPatientCounts,
            'departmentId' => $department,
            'deptPatientCounts' => $deptPatientCounts,
        ]);
        return redirect()->route('admin.dashboard');
    }
}
