<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DoctorScheduleRequest;
use Carbon\CarbonPeriod;
use App\Models\User;
use App\Models\Schedule;
use App\Models\Doctor;

class DoctorScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $scheduleInterval = Schedule::find(1);
        // dd($scheduleInterval->time_intervals);
        $schedules = Schedule::with('appointment')->orderBy('created_at','desc')->simplePaginate(10);
        $schedules->withPath('');
        return view('admin_Panel.doctor_schedule.schedule',compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = Doctor::all();
        return view('admin_Panel.doctor_schedule.add-schedule',compact('doctors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoctorScheduleRequest $request)
    {
        $validatedData = $request->validated();
        Schedule::create($validatedData);
        return redirect()->route('schedule.index')->with('message','Doctor Schedule has been set successfully !!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctors = Doctor::all();
        $schedule = Schedule::findOrFail($id);
        return view('admin_Panel.doctor_schedule.edit-schedule',compact('schedule','doctors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DoctorScheduleRequest $request, $id)
    {
        $validatedData = $request->validated();
        Schedule::where('id', $id)->update($validatedData);
        return redirect()->route('schedule.index')->with('message','Doctor Schedule has been updated successfully!!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Schedule::findOrFail($id)->delete();
        return redirect()->route('schedule.index')->with('message','Doctor Schedule has been deleted successfully!!!');
    }
}
