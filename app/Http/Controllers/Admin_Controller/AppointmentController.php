<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\User;


class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::orderBy('created_at','desc')->simplePaginate(8);
        $appointments->withPath('');
        return view('admin_Panel.appointment.appointments',compact('appointments'));
    }
}
