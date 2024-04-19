<?php

namespace App\Http\Controllers\General_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ScheduleRequest;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\Schedule;
use App\Models\User;
use App\Notifications\ScheduleCreatedNotification;


class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $doctor = $user->doctor;
        $department = $doctor->departments;
        $schedules = $doctor->schedules;
        return view('general_dashboard.doctor_dashboard.schedule.index',compact('doctor','department','schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('general_dashboard.doctor_dashboard.schedule.create-schedule');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(ScheduleRequest $request)
    {
        $validatedData = $request->validated();
        $user = Auth::user();
        $doctor = $user->doctor;
        $doctor_id = $doctor->id;
        $validatedData['doctor_id'] = $doctor_id;
        $schedule = Schedule::create($validatedData);

        $admin = User::where('role_id', 1)->first();
        $admin->notify(new ScheduleCreatedNotification($schedule, $doctor, 'schedule_create'));

        return redirect()->route('my-schedule.index')->with('message','Your Schedule has been set successfully !!!');
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
        $schedule = Schedule::findOrFail($id);
        return view('general_dashboard.doctor_dashboard.schedule.edit-schedule',
            compact('schedule'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleRequest $request, $id)
    {
        $validatedData = $request->validated();
        $schedule = Schedule::findOrFail($id);
        $schedule->update();
        // $schedule = Schedule::where('id', $id)->update($validatedData);

        $user = Auth::user();
        $doctor = $user->doctor;
        $admin = User::where('role_id', 1)->first();
        $admin->notify(new ScheduleCreatedNotification($schedule, $doctor, 'schedule_update'));

        return redirect()->route('my-schedule.index')->with('message','Your Schedule has been updated successfully !!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        $user = Auth::user();
        $doctor = $user->doctor;
        $admin = User::where('role_id', 1)->first();
        $admin->notify(new ScheduleCreatedNotification($schedule, $doctor, 'schedule_delete'));

        return redirect()->route('my-schedule.index')->with('message','Your Schedule has been deleted successfully !!!');
    }
}
