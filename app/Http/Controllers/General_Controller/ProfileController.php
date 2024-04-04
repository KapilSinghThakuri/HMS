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

class ProfileController extends Controller
{
    public function index()
    {
        $users = Auth::user();
        $id = $users->id;
        $doctor_basic = Doctor::where('user_id', $id)->firstOrFail();
        $doctor_id = $doctor_basic->id;
        $doctor_edu = Education::where('doctor_id',$doctor_id)->first();
        $doctor_exp = Experience::where('doctor_id',$doctor_id)->first();

        return view('general_dashboard.doctor_dashboard.profile.index',
            compact('doctor_basic','doctor_edu','doctor_exp'));
    }
    public function edit()
    {
        $users = Auth::user();
        $id = $users->id;
        $doctor_basic = Doctor::where('user_id', $id)->firstOrFail();
        $doctor_id = $doctor_basic->id;
        $doctor_edu = Education::where('doctor_id',$doctor_id)->first();
        $doctor_exp = Experience::where('doctor_id',$doctor_id)->first();

        $countries = DB::table('countries')->get();
        $provinces = DB::table('provinces')->get();
        $departments = Department::all();

        // Retreiving districts based on province
        $doctor_province = Province::findOrFail($doctor_basic->province_id);
        $doctor_districts = $doctor_province->districts;
        // Retreiving municipalities based on district
        $doctor_district = District::findOrFail($doctor_basic->district_id);
        $doctor_municipalities = $doctor_district->municipalities;
        // Retreiving department based on doctor's department id
        $related_department = $doctor_basic->departments;
        $related_municipality = $doctor_basic->municipality;
        $related_district = $doctor_basic->district;
        $related_province = $doctor_basic->province;

        return view('general_dashboard.doctor_dashboard.profile.edit',
            compact('doctor_basic','doctor_edu','doctor_exp','related_department',
            'related_municipality','related_district','related_province',
            'departments','countries','provinces','doctor_districts','doctor_municipalities'));
    }
    public function getDistrictByProvinceEdit($provinceId)
    {
        $districts = District::where('province_id',$provinceId)->get();
        return response()->json($districts);
    }
    public function getMunicipalityByDistrictEdit($districtId)
    {
        $municipalities = Municipality::where('district_id', $districtId)->get();
        return response()->json($municipalities);
    }
    public function update(Request $request)
    {
        dd($request->all());
    }
}
