<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DoctorRequst;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Doctor;
use App\Models\Education;
use App\Models\Experience;
use App\Models\User;
use App\Models\Address;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::all();
        $educations = Education::all();
        $experiences = Experience::all();
        foreach ($educations as $value) {
             $specialization = $value->specialization;
        }
        $addresses = Address::all();
        return view('admin_Panel.doctor.doctors',
            compact('doctors','educations','experiences','addresses','specialization'));
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
        $districts = DB::table('districts')->get();
        $municipalities = DB::table('municipalities')->get();
        return view('admin_Panel.doctor.add-doctor',
            compact('countries','districts','provinces','municipalities','departments'));
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
            return back()->with('fail', 'Please upload a profile picture!!!');
        }

        $doctor = Doctor::create([
            'user_id' => $user_id,
            'department_id' =>$validated_data['department_id'],
            'first_name' => $validated_data['first_name'],
            'middle_name' => $validated_data['middle_name'] == "" ? "" : $validated_data['middle_name'],
            'last_name' => $validated_data['last_name'],
            'profile' => '/admin_Assets/img/doctors'.'/'.$fileName,
            'gender' => $validated_data['gender'],
            'date_of_birth_BS' => $validated_data['dobBS'],
            'date_of_birth_AD' => $validated_data['dobAD'],
            'email' => $validated_data['email'],
            'phone' => $validated_data['phone'],
        ]);
        $doctor_id = $doctor->id;

        Address::create([
            'doctor_id' => $doctor_id,
            'country' => $validated_data['country'],
            'district' => $validated_data['district'],
            'province' => $validated_data['province'],
            'municipality' => $validated_data['municipality'],
            'street' => $validated_data['street'],
        ]);

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
        return redirect()->route('doctor.index')->with('success','Doctor Added Successfully !!!');
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
        $doctor_addr = Address::where('doctor_id',$id)->first();
        return view('admin_Panel.doctor.profile',
            compact('doctor_basic','doctor_exp','doctor_addr','doctor_edu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor_basic = Doctor::findOrFail($id);
        $doctor_edu = Education::where('doctor_id',$id)->first();
        $doctor_exp = Experience::where('doctor_id',$id)->first();
        $doctor_addr = Address::where('doctor_id',$id)->first();
        return view('admin_Panel.doctor.edit-doctor',
        compact('doctor_basic'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
