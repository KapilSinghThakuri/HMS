<?php

namespace App\Http\Controllers\General_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneralDashboardController extends Controller
{
    public function index()
    {
        return view('general_dashboard.index');
    }
}
