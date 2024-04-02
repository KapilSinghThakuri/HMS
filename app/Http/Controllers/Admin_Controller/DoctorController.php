<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DoctorRequst;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $educations = Education::all();
        $experiences = Experience::all();

        $doctors = Doctor::all();
        // dd($doctors[0]->country->english_name);
        // $countryId = $doctors->country_id;

        return view('admin_Panel.doctor.doctors',
            compact('educations','experiences','doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = DB::table('departments')->get();
        $countries = DB::table('countries')->get();
        $provinces = DB::table('provinces')->get();
        // $districts = DB::table('districts')->get();
        // $municipalities = DB::table('municipalities')->get();
        return view('admin_Panel.doctor.add-doctor',
            compact('departments','countries','provinces'));
    }

    public function getDistrictByProvince($provinceId)
    {
        $districts = District::where('province_id',$provinceId)->get();
        return response()->json($districts);
    }
    public function getMunicipalityByDistrict($districtId)
    {
        $municipalities = Municipality::where('district_id', $districtId)->get();
        return response()->json($municipalities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoctorRequst $request)
    {
        $validated_data = $request->validated();
        $username = $validated_data['first_name'] .' '. $validated_data['middle_name'] .' '. $validated_data['last_name'];
        $user_address = $validated_data['province'] .'-'. $validated_data['district'] .'-'. $validated_data['municipality'] .'-'. $validated_data['street'];
        $user = User::create([
            'role_id' => 2,
            'username' => $username,
            'email' => $validated_data['email'],
            'password' => Hash::make($validated_data['password']),
            'address' => $user_address,
            'phone' => $validated_data['phone'],
        ]);
        $user_id = $user->id;

        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('admin_Assets/img/doctors'), $fileName);
        } else {
            return back()->with('fail_message', 'Please upload a profile picture!!!');
        }

        $doctor = Doctor::create([
            'user_id' => $user_id,
            'department_id' =>$validated_data['department_id'],
            'first_name' => $validated_data['first_name'],
            'middle_name' => $validated_data['middle_name'] == " " ? " " : $validated_data['middle_name'],
            'last_name' => $validated_data['last_name'],
            'profile' => '/admin_Assets/img/doctors'.'/'.$fileName,
            'gender' => $validated_data['gender'],
            'date_of_birth_BS' => $validated_data['dobBS'],
            'date_of_birth_AD' => $validated_data['dobAD'],
            'email' => $validated_data['email'],
            'phone' => $validated_data['phone'],

            'country_id' => $validated_data['country'],
            'province_id' => $validated_data['province'],
            'district_id' => $validated_data['district'],
            'province_id' => $validated_data['province'],
            'municipality_id' => $validated_data['municipality'],
            'street' => $validated_data['street'],
        ]);
        $doctor_id = $doctor->id;

        Education::create([
            'doctor_id' => $doctor_id,
            'institute_name' => $validated_data['institute_name'],
            'medical_degree' => $validated_data['medical_degree'],
            'graduation_year_BS' => $validated_data['grad_yearBS'],
            'graduation_year_AD' => $validated_data['grad_yearAD'],
            'specialization' => $validated_data['specialization'],
        ]);

        Experience::create([
            'doctor_id' => $doctor_id,
            'license_no' => $validated_data['license_no'],
            'org_name' => $validated_data['org_name'],
            'start_date_BS' => $validated_data['start_dateBS'],
            'start_date_AD' => $validated_data['start_dateAD'],
            'end_date_BS' => $validated_data['end_dateBS'],
            'end_date_AD' => $validated_data['end_dateAD'],
            'job_description' => $validated_data['jobDescription'],
        ]);
        return redirect()->route('doctor.index')->with('success_message','Doctor Added Successfully !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor_basic = Doctor::findOrFail($id);
        $doctor_edu = Education::where('doctor_id',$id)->first();
        $doctor_exp = Experience::where('doctor_id',$id)->first();

        return view('admin_Panel.doctor.profile',
            compact('doctor_basic','doctor_exp','doctor_edu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = DB::table('countries')->get();
        $provinces = DB::table('provinces')->get();
        $districts = DB::table('districts')->get();
        $municipalities = DB::table('municipalities')->get();

        $departments = Department::all();

        $doctor_basic = Doctor::findOrFail($id);

        $related_department = $doctor_basic->departments;
        $related_municipality = $doctor_basic->municipality;
        $related_district = $doctor_basic->district;
        $related_province = $doctor_basic->province;

        $doctor_edu = Education::where('doctor_id',$id)->first();
        $doctor_exp = Experience::where('doctor_id',$id)->first();
        $doctor_addr = Address::where('doctor_id',$id)->first();

        return view('admin_Panel.doctor.edit-doctor',
        compact('doctor_basic','doctor_exp','doctor_addr','doctor_edu','related_department',
            'related_municipality','related_district','related_province',
            'departments','countries','provinces','districts','municipalities'));
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'first_name' => 'nullable|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'profile' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072',
            'phone' => 'nullable|string|max:255',
            'department_id' => 'nullable|exists:departments,id',
            'date_of_birth_BS' => 'nullable|date',
            'date_of_birth_AD' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female',
            'country' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'municipality' => 'nullable|string|max:255',
            'street' => 'nullable|string|max:255',
            'institute_name' => 'nullable|string|max:255',
            'medical_degree' => 'nullable|string|max:255',
            'graduation_year_BS' => 'nullable|date',
            'graduation_year_AD' => 'nullable|date',
            'specialization' => 'nullable|string|max:255',
            'org_name' => 'nullable|string|max:255',
            'license_no' => 'nullable|string|max:255',
            'start_date_BS' => 'nullable|date',
            'start_date_AD' => 'nullable|date',
            'end_date_BS' => 'nullable|date',
            'end_date_AD' => 'nullable|date',
            'job_description' => 'nullable|string',
            'email' => 'nullable|email|unique:doctors,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
            'password_confirmation' => 'nullable|string|min:6'
        ];

        $validated_data = $request->validate($rules);

        $doctors = Doctor::findOrFail($id);
        $doctor_user = User::findOrFail($doctors->user_id);
        $doctor_edu = Education::where('doctor_id', $id)->firstOrFail();
        $doctor_exp = Experience::where('doctor_id', $id)->firstOrFail();

        $username = $validated_data['first_name'] .' '. $validated_data['middle_name'] .' '. $validated_data['last_name'];
        $user_address = $validated_data['province'] .'-'. $validated_data['district'] .'-'. $validated_data['street'];

        $doctor_user -> update([
            'username' => $username,
            'email' => $validated_data['email'],
            'password' => Hash::make($validated_data['password']),
            'address' => $user_address,
            'phone' => $validated_data['phone'],
        ]);

        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('admin_Assets/img/doctors'), $fileName);
            $doctors->update([
                'profile' => '/admin_Assets/img/doctors'.'/'.$fileName,
            ]);
        }

        $doctors->update([
            'department_id' =>$validated_data['department_id'],
            'first_name' => $validated_data['first_name'],
            'middle_name' => $validated_data['middle_name'],
            'last_name' => $validated_data['last_name'],
            'gender' => $validated_data['gender'],
            'date_of_birth_BS' => $validated_data['date_of_birth_BS'],
            'date_of_birth_AD' => $validated_data['date_of_birth_AD'],
            'email' => $validated_data['email'],
            'phone' => $validated_data['phone'],

            'country_id' => $validated_data['country'] ,
            'province_id' => $validated_data['province'],
            'district_id' => $validated_data['district'],
            'municipality_id' => $validated_data['municipality'],
            'street' => $validated_data['street'],
        ]);

        $doctor_edu->update([
            'institute_name' => $validated_data['institute_name'],
            'medical_degree' => $validated_data['medical_degree'],
            'graduation_year_BS' => $validated_data['graduation_year_BS'],
            'graduation_year_AD' => $validated_data['graduation_year_AD'],
            'specialization' => $validated_data['specialization'],
        ]);

        $doctor_exp->update([
            'license_no' => $validated_data['license_no'],
            'org_name' => $validated_data['org_name'],
            'start_date_BS' => $validated_data['start_date_BS'],
            'start_date_AD' => $validated_data['start_date_AD'],
            'end_date_BS' => $validated_data['end_date_BS'],
            'end_date_AD' => $validated_data['end_date_AD'],
        ]);
    return redirect()->route('doctor.index')->with('success_message', 'Doctor Updated Successfully !!!');
}



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor_edu = Education::where('doctor_id', $id)->first();
        $doctor_edu->delete();

        $doctor_exp = Experience::where('doctor_id', $id)->first();
        $doctor_exp->delete();

        $doctor_basic = Doctor::where('id', $id)->first();
        $doctor_basic->delete();

        $user_id = $doctor_basic->user_id;
        $doctor = User::where('id', $user_id)->first();
        $doctor->delete();

        return redirect()->route('doctor.index')->with('success_message','Doctor deleted Successfully !!!');
    }
}
