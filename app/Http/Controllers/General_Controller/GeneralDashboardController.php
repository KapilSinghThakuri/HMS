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

class GeneralDashboardController extends Controller
{
    public function index()
    {
        $departments = Department::with('doctors')->get();

        $doc = Department::with('doctors')->find(1);
        dd($doc);
        $doctors = Doctor::all();
        return view('general_dashboard.index',compact('departments','doctors'));
    }
}
