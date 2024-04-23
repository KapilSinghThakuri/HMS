<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PragmaRX\Countries\Package\Countries;

class RegisterController extends Controller
{
    public function index()
    {
        return view('admin_Panel.registration.register');
    }
}
