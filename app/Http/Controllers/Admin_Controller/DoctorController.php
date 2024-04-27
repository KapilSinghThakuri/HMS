<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DoctorRequest;
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
use App\Notifications\DoctorCreatedNotification;

class DoctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view doctor', ['only' => ['index','show','doctorTrash']]);
        $this->middleware('permission:create doctor', ['only' => ['create','store']]);
        $this->middleware('permission:edit doctor', ['only' => ['edit','update']]);
        $this->middleware('permission:delete doctor', ['only' => ['destroy','doctorRestore','permanentDelete','emptyDoctor']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::with('educations','experiences')->get();
        return view('admin_Panel.doctor.doctors',
            compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::get();
        $provinces = Province::get();
        return view('admin_Panel.doctor.add-doctor',
            compact('countries','provinces'));
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
    public function store(DoctorRequest $request)
    {
        $validatedData = $request->validated();
        DB::beginTransaction();
        try {
            $username = $validatedData['first_name'] .' '. $validatedData['middle_name'] .' '. $validatedData['last_name'];
            $user_address = $validatedData['province_id'] .'-'. $validatedData['district_id'] .'-'. $validatedData['municipality_id'] .'-'. $validatedData['street'];

            $validatedData['role_id'] = 2;
            $validatedData['username'] = $username;
            $validatedData['password'] = Hash::make($validatedData['password']);
            $user = User::create($validatedData);

            $user_id = $user->id;
            if ($request->hasFile('profile')) {
                $file = $request->file('profile');
                $fileName = time().'.'.$file->getClientOriginalExtension();
                $file->move(public_path('admin_Assets/img/doctors'), $fileName);
            } else {
                return back()->with('fail_message', 'Please upload a profile picture!!!');
            }
            $validatedData['user_id'] = $user_id;
            $validatedData['profile'] = '/admin_Assets/img/doctors'.'/'.$fileName;
            $doctor = Doctor::create($validatedData);

            $doctor_id = $doctor->id;
            $validatedData['doctor_id'] = $doctor_id;

            if(isset($validatedData['institute_name'])) {
                foreach ($validatedData['institute_name'] as $key => $value) {
                    Education::create([
                        'doctor_id' => $doctor_id,
                        'institute_name' => $validatedData['institute_name'][$key],
                        'medical_degree' => $validatedData['medical_degree'][$key], // Access corresponding medical_degree using the same index
                        'graduation_year_BS' => $validatedData['graduation_year_BS'][$key],
                        'graduation_year_AD' => $validatedData['graduation_year_AD'][$key],
                        'specialization' => $validatedData['specialization'][$key],
                    ]);
                }
            }

            if(isset($validatedData['org_name'])) {
                foreach ($validatedData['org_name'] as $key => $value) {
                    Experience::create([
                        'doctor_id' => $doctor_id,
                        'license_no' => $validatedData['license_no'],
                        'org_name' => $validatedData['org_name'][$key],
                        'start_date_BS' => $validatedData['start_date_BS'][$key],
                        'start_date_AD' => $validatedData['start_date_AD'][$key],
                        'end_date_BS' => $validatedData['end_date_BS'][$key],
                        'end_date_AD' => $validatedData['end_date_AD'][$key],
                        'job_description' => $validatedData['job_description'][$key],
                    ]);
                }
            }
            // For sending the doctor created notifications to Admin
            $admin = User::where('role_id', 1)->first();
            $admin->notify(new DoctorCreatedNotification($doctor, 'doctor_create'));

            DB::commit();
            return redirect()->route('doctor.index')->with('message','Doctor Added Successfully !!!');
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->route('doctor.index')->with('message','Error: '. $e->getMessage());
        }
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
        $doctor_edu = Education::where('doctor_id',$id)->get();
        $doctor_exp = Experience::where('doctor_id',$id)->get();
        $temp_province = Province::where('id', $doctor_basic->temp_province_id)->first();
        $temp_district = District::where('id', $doctor_basic->temp_district_id)->first();
        $temp_municipality = Municipality::where('id', $doctor_basic->temp_municipality_id)->first();
        return view('admin_Panel.doctor.profile',
            compact('doctor_basic','doctor_exp','doctor_edu','temp_province','temp_district','temp_municipality'));
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
        $departments = Department::all();

        $doctor_basic = Doctor::findOrFail($id);
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

        $doctor_edu = Education::where('doctor_id',$id)->first();
        $doctor_exp = Experience::where('doctor_id',$id)->first();
        $doctor_addr = Address::where('doctor_id',$id)->first();

        return view('admin_Panel.doctor.edit-doctor',
        compact('doctor_basic','doctor_exp','doctor_addr','doctor_edu','related_department',
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DoctorRequest $request, $id)
    {
        $validatedData = $request->validated();
        DB::beginTransaction();
        try {
            $doctor = Doctor::findOrFail($id);
            $doctor_user = User::findOrFail($doctor->user_id);
            $username = $validatedData['first_name'] .' '. $validatedData['middle_name'] .' '. $validatedData['last_name'];
            $user_address = $validatedData['province_id'] .'-'. $validatedData['district_id'] .'-'. $validatedData['street'];
            $validatedData['username'] = $username;
            $validatedData['address'] = $user_address;
            $validatedData['password'] = Hash::make($validatedData['password']);

            $doctor_user->update($validatedData);

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
                $validatedData['profile'] = '/admin_Assets/img/doctors'.'/'.$fileName;
            }
            $doctor->update($validatedData);

            // Update education details
            Education::where('doctor_id', $id)->delete();
            foreach ($validatedData['institute_name'] as $key => $value) {
                Education::updateOrCreate(
                    [
                        'doctor_id' => $doctor->id,
                        'institute_name' => $validatedData['institute_name'][$key],
                        'medical_degree' => $validatedData['medical_degree'][$key],
                        'graduation_year_BS' => $validatedData['graduation_year_BS'][$key],
                        'graduation_year_AD' => $validatedData['graduation_year_AD'][$key],
                        'specialization' => $validatedData['specialization'][$key],
                    ]
                );
            }
            // Update experience details
            Experience::where('doctor_id', $id)->delete();
            foreach ($validatedData['org_name'] as $key => $value) {
                Experience::updateOrCreate(
                    [
                        'doctor_id' => $doctor->id,
                        'license_no' => $validatedData['license_no'],
                        'org_name' => $validatedData['org_name'][$key],
                        'start_date_BS' => $validatedData['start_date_BS'][$key],
                        'start_date_AD' => $validatedData['start_date_AD'][$key],
                        'end_date_BS' => $validatedData['end_date_BS'][$key],
                        'end_date_AD' => $validatedData['end_date_AD'][$key],
                        'job_description' => $validatedData['job_description'][$key],
                    ]
                );
            }

            DB::commit();
            return redirect()->route('doctor.index')->with('message', 'Doctor Updated Successfully !!!');
        } catch (Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor_edu = Education::where('doctor_id', $id)->delete();
        $doctor_exp = Experience::where('doctor_id', $id)->delete();

        $doctor_basic = Doctor::where('id', $id)->first();
        if ($doctor_basic) {
            $doctor_basic->delete();
        }

        $user_id = $doctor_basic->user_id;
        if ($user_id) {
            $doctor = User::find($user_id);
            if ($doctor) {
                $doctor->delete();
            }
        }
        return redirect()->route('doctor.index')->with('message','Doctor deleted Successfully !!!');
    }

    public function doctorTrash()
    {

        $softDeletedDoctors = Doctor::with([
            // Also load soft deleted departments, educations, experiences
            'departments' => function ($query) {
                $query->withTrashed();
            },
            'educations' => function ($query) {
                $query->withTrashed();
            },
            'experiences' => function ($query) {
                $query->withTrashed();
            },
            'user' => function ($query) {
                $query->withTrashed();
            },
        ])->onlyTrashed()->get();

        return view('admin_Panel.doctor.doctor-trash', compact('softDeletedDoctors'));
    }
    public function doctorRestore($doctorId)
    {
        $softDeletedDoctor = Doctor::onlyTrashed()->find($doctorId);
        if ($softDeletedDoctor) {
            $user_id = $softDeletedDoctor->user_id;
            $softDeletedDoctor->restore();
            User::onlyTrashed()->where('id', $user_id)->restore();
            Education::onlyTrashed()->where('doctor_id', $doctorId)->restore();
            Experience::onlyTrashed()->where('doctor_id', $doctorId)->restore();
        }
        return redirect()->route('doctor.index')->with('message','Doctor Restored Successfully!!!');
    }

    public function permanentDelete($doctorId)
    {
        DB::beginTransaction();
        try {
            $softDeletedDoctor = Doctor::onlyTrashed()->find($doctorId);
            if ($softDeletedDoctor) {
                Education::onlyTrashed()->where('doctor_id', $doctorId)->forceDelete();
                Experience::onlyTrashed()->where('doctor_id', $doctorId)->forceDelete();

                $softDeletedDoctor->forceDelete();
                if ($softDeletedDoctor) {
                    if ($softDeletedDoctor->profile) {
                        $imagePath = public_path($softDeletedDoctor->profile);
                        if (file_exists($imagePath)) {
                            unlink($imagePath);
                        }
                    }
                }

                $user_id = $softDeletedDoctor->user_id;
                User::onlyTrashed()->where('id', $user_id)->forceDelete();

                DB::commit();

                return redirect()->route('doctor.trash')->with('message','Doctor has been permanently deleted Successfully!!!');
            }
        }catch (Exception $e) {
        DB::rollback();
        return $e->getMessage();
        }
    }

    public function emptyDoctor()
    {
        Education::onlyTrashed()->forceDelete();
        Experience::onlyTrashed()->forceDelete();
        Doctor::onlyTrashed()->forceDelete();
        $trashedDoctor = Doctor::onlyTrashed()->get();
        if ($trashedDoctor) {
            foreach ($trashedDoctor as $doctor) {
                if ($doctor->profile) {
                    $imagePath = public_path($doctor->profile);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            }
        }
        User::onlyTrashed()->forceDelete();
        return redirect()->route('doctor.index')->with('message','Doctors has been permanently deleted Successfully!!!');
    }
}
