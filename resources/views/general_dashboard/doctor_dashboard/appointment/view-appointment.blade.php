@extends('general_dashboard.doctor_dashboard.layout.main')
@section('Main-container')
    <div class="page-wrapper">
        <div class="content">
            <div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
                <div class="col-sm-6">
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('patient.appointment') }}" class="btn btn-danger btn-rounded"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
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
                            <h5 class="card-title mb-2" style="margin: 0;">Medical Report</h5>
                            @if(!empty($appointments->patient->medical_history))
                                <button
                                    class="btn btn-sm btn-success mt-4"
                                    data-toggle="modal"
                                    data-target="#medicalReportModal"
                                >
                                    View Medical Report
                                </button>
                            @else
                                <p>No medical report available.</p>
                            @endif
                        </div>
                    </div>

                    <div class="modal fade" id="medicalReportModal" tabindex="-1" role="dialog" aria-labelledby="medicalReportModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header p-2">
                                    <h4 class="modal-title" id="medicalReportModalLabel">Medical Report</h4>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                                <div class="modal-body">
                                    <iframe
                                        class="medical_report"
                                        src="{{ asset($appointments->patient->medical_history) }}"
                                        width="100%"
                                        height="100%"
                                        frameborder="0"
                                        allowfullscreen
                                    ></iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection