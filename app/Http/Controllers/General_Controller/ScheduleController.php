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
        $fromTime = $request->from;
        $toTime = $request->to;

        $start_time = Carbon::createFromFormat('H:i', $fromTime);
        $end_time = Carbon::createFromFormat('H:i', $toTime);

        // Create a period of 30-minute intervals between start and end times
        $period = CarbonPeriod::create($start_time, '30 minutes', $end_time);
        $departed_schedule = [];
        foreach ($period as $interval) {
            $departed_schedule[] = $interval->format('H:i');
        }
        $grouped_schedule = collect($departed_schedule)
                            ->slice(0, -1)
                            ->map(function ($item, $key) use ($departed_schedule){
                        return[
                            'from' => $item,
                            'to' => $departed_schedule[$key + 1]
                        ];
                    });
        // dd($grouped_schedule);
        $user = Auth::user();
        $doctor = $user->doctor;
        $doctor_id = $doctor->id;
        foreach ($grouped_schedule as $schedule) {
            $schedule['doctor_id'] = $doctor_id;
            $schedule['in'] = $request->in;
            Schedule::create($schedule);
        }
        return redirect()->route('my-schedule.index')->with('success_message','Your Schedule has been set successfully !!!');
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
        $schedule = Schedule::where('id', $id)->first();
        $date = $schedule->in;
        $time_interval = Schedule::where('in', $date)->get();

        // Fetching the first element of the first array
        $start_time = $time_interval->first()['from'];

        // Fetching the last element of the last array
        $end_time = $time_interval->last()['to'];

        // dd($start_time . ' - ' . $end_time);
        return view('general_dashboard.doctor_dashboard.schedule.edit-schedule',
            compact('date','start_time','end_time'));
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
        $schedule = Schedule::where('id', $id)->first();
        $date = $schedule->in;
        Schedule::whereDate('in', $date)->delete();
        return redirect()->route('my-schedule.index')->with('success_message','Your Schedule has been deleted successfully !!!');
    }
}
