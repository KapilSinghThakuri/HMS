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
        $doctorId = $request->doctor_id;
        $currentYear = Carbon::now()->year;
        $data = DB::table('appointments') // Use the correct table name
            ->selectRaw('MONTH(created_at) as month, COUNT(DISTINCT patient_id) as patient_count') // Group by month and count distinct patients
            ->where('doctor_id', $doctorId) // Filter by doctor ID
            ->whereYear('created_at', $currentYear) // Filter by the current year
            ->groupBy('month') // Group by month
            ->orderBy('month', 'asc') // Sort by month
            ->get()
            ->keyBy('month');

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
        session(['doctorId' => $doctorId, 'labels' => $labels, 'patientCounts'=> $patientCounts]);
        return redirect()->route('admin.dashboard');
    }
}
