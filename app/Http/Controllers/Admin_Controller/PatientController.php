<?php

namespace App\Http\Controllers\Admin_Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Patient;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view patient', ['only' => ['index']]);
    }

    public function index()
    {
        $patients = Patient::orderBy('created_at','desc')->simplePaginate(8);
        $patients->withPath('');
        return view('admin_Panel.patient.patients',compact('patients'));
    }

    public function searchPatient(Request $request)
    {
        $searchedValue = $request->searchedInput;
        return response()->json($searchedValue);
    }
}
