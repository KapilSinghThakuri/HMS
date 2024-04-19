<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Patient;
use App\Models\Appointment;
use App\Models\Department;



class DashboardController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('educations')->orderBy('created_at','desc')->take(5)->get();
        $patients = Patient::with('appointment')->orderBy('created_at','desc')->get();
        $appointments = Appointment::all();
        $departments = Department::all();
        return view('admin_Panel.index',compact('doctors','patients','appointments','departments'));
    }
}
