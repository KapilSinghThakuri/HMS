@extends('general_dashboard.doctor_dashboard.layout.main')
@section('Main-container')
    <div class="page-wrapper">
        <div class="content">
            {{ Breadcrumbs::render() }}
            <div class="row">
                <div class="col-sm-4 col-3">
                    <h4 class="page-title">Appointment Details</h4>
                </div>
                <div class="col-sm-8 col-9 text-right m-b-20">
                    <a href="{{ route('patient.appointment')}}" class="btn btn btn-danger btn-rounded float-right"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card appointment-card">
                        <div class="card-body">
                            <h5 class="card-title">Patient Information</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <p class="card-text"><strong>Patient Name:</strong> {{ $appointments->patient->fullname }}</p>
                                    <p class="card-text"><strong>Gender:</strong> {{ $appointments->patient->gender }}</p>
                                    <p class="card-text"><strong>Address:</strong> {{ $appointments->patient->permanent_address }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p class="card-text"><strong>Phone:</strong> {{ $appointments->patient->phone }}</p>
                                    <p class="card-text"><strong>Email:</strong> {{ $appointments->patient->email }}</p>
                                </div>
                            </div>
                            <p class="card-text"><strong>Reason for Appointment:</strong> {{ $appointments->reason }}</p>
                            <p class="card-text"><strong>Appointment Date:</strong> January 20, 2024</p>
                            <p class="card-text"><strong>Doctor:</strong> Dr. Smith</p>
                            <p class="card-text"><strong>Department:</strong> Cardiology</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title" style="margin: 0;">Medical Report</h5>
                            <iframe class="medical_report" src="{{ asset( $appointments->patient->medical_history )}}"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection