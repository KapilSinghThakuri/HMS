<?php

namespace App\Http\Controllers\General_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
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
////////////////////////           PROFILE EDIT PART               ///////////////////////////////
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



////////////////////////           PROFILE UPDATE PART               ///////////////////////////////
    public function update(ProfileRequest $request)
    {
        $validatedData = $request->validated();
        // dd($validatedData);
        $degreeRules = ProfileRequest::degreeRules();
        $validatedDegreeData = $request->validate($degreeRules);
        // dd($validatedDegreeData);
        $experienceRules = ProfileRequest::experienceRules();
        $validatedExperienceData = $request->validate($experienceRules);
        // dd($validatedExperienceData);

        $users = Auth::user();
        $id = $users->id;
        // Update user details
        $username = $validatedData['first_name'] .' '. $validatedData['middle_name'] .' '. $validatedData['last_name'];
        $user_address = $validatedData['province'] .'-'. $validatedData['district'] .'-'. $validatedData['street'];
        $users -> update([
            'username' => $username,
            'email' => $validatedData['email'],
            'address' => $user_address,
            'phone' => $validatedData['phone'],
        ]);

        // Update doctor details
        $doctor = $users->doctor;
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $fileName = time().'.'.$file->getClientOriginalExtension();

            // Delete the previous image if it exists
            if ($doctor->profile) {
                $previousImagePath = public_path($doctor->profile);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }

            $file->move(public_path('admin_Assets/img/doctors'), $fileName);
            $doctor->update([
                'profile' => '/admin_Assets/img/doctors'.'/'.$fileName,
            ]);
        }
        $doctorData = [
            'user_id' => $id,
            'department_id' =>$validatedData['department_id'],
            'first_name' => $validatedData['first_name'],
            'middle_name' => $validatedData['middle_name'],
            'last_name' => $validatedData['last_name'],
            'gender' => $validatedData['gender'],
            'date_of_birth_BS' => $validatedData['date_of_birth_BS'],
            'date_of_birth_AD' => $validatedData['date_of_birth_AD'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'country_id' => $validatedData['country'],
            'province_id' => $validatedData['province'],
            'district_id' => $validatedData['district'],
            'municipality_id' => $validatedData['municipality'],
            'street' => $validatedData['street'],
        ];

        if (isset($validatedData['country_tempName'])) {
            $doctorData['temp_country_id'] = $validatedData['country_tempName'];
        }
        if (isset($validatedData['province_tempName'])) {
            $doctorData['temp_province_id'] = $validatedData['province_tempName'];
        }
        if (isset($validatedData['district_tempName'])) {
            $doctorData['temp_district_id'] = $validatedData['district_tempName'];
        }
        if (isset($validatedData['municipality_tempName'])) {
            $doctorData['temp_municipality_id'] = $validatedData['municipality_tempName'];
        }
        if (isset($validatedData['street_tempName'])) {
            $doctorData['temp_street'] = $validatedData['street_tempName'];
        }
        $doctor->update($doctorData);

        // Update education details
        $educations = $doctor->educations->first();
        $validatedData['doctor_id'] = $doctor->id;
        $educations->update($validatedData);

        // Update experience details
        $experiences = $doctor->experiences->first();
        $validatedData['doctor_id'] = $doctor->id;
        $experiences->update($validatedData);

        return redirect()->route('doctor.profile')->with('success_message','Your profile has been updated successfully !!!');
    }
}
