<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;
use App\Models\User;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Department;
use App\Models\Appointment;


class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view department', ['only' => ['index','show']]);
        $this->middleware('permission:create department', ['only' => ['create','store']]);
        $this->middleware('permission:edit department', ['only' => ['edit','update']]);
        $this->middleware('permission:delete department', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::all();
        return view('admin_Panel.department.departments',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin_Panel.department.add-department');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        $validated = $request->validated();
        Department::create($validated);
        return redirect()->route('department.index')->with('success_message', 'Department added successfully!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctors = Doctor::where('department_id',$id)->get();
        $patientCount = 0;
        foreach ($doctors as $doctor) {
            $doctor = Doctor::withCount('appointments')->find($doctor->id);
            $patientCount += $doctor->appointments_count;
        }
        // dd($patientCount);

        $doctorCount = $doctors->count();
        $departments = Department::where('id',$id)->first();
        return view('admin_Panel.department.department-details',compact('departments','doctorCount','patientCount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departments = Department::where('id',$id)->first();
        return view('admin_Panel.department.edit-department',compact('departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request, $id)
    {
        $department = Department::findOrFail($id);
        $validated_data = $request->validated();
        $department->update($validated_data);
        return redirect()->route('department.index')->with('success_message', 'Department updated successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::where('id', $id)->first();
        $department->delete();
        return redirect()->route('department.index')->with('success_message', 'Department deleted successfully!!!');
    }
}
