<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;

class DashboardController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        return view('admin_Panel.index',compact('doctors'));
    }
}
