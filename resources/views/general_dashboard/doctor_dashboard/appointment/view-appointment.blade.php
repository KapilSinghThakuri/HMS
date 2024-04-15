@extends('general_dashboard.doctor_dashboard.layout.main')
@section('Main-container')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-4 col-3">
                    <h4 class="page-title">Appointment Details</h4>
                </div>
                <div class="col-sm-8 col-9 text-right m-b-20">
                    <a href="{{ route('doctor.dashboard')}}" class="btn btn btn-primary btn-rounded float-right">Back Dashboard</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="defination-card card" style="padding: 25px;">
                        <dl>
                          <dt>Patient Name:</dt>
                          <dd>Black hot drink</dd>
                          <dt>Gender:</dt>
                          <dd>{{ $appointments->patient->gender }}</dd>
                          <dt>Age:</dt>
                          <dd>{{ $appointments->patient->age }} years</dd>
                          <dt>Address:</dt>
                          <dd>{{ $appointments->patient->permanent_address }}</dd>
                          <dt>Phone:</dt>
                          <dd>{{ $appointments->patient->phone }}</dd>
                          <dt>Email:</dt>
                          <dd>{{ $appointments->patient->email }}</dd>
                          <dt>Reason:</dt>
                          <dd>{{ $appointments->reason }}</dd>
                          <dt>Medical History:</dt>
                          </dd>
                            <iframe src="{{ asset($appointments->patient->medical_history) }}" width="300px" height="400px"></iframe>
                          <dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection