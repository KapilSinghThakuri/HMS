@extends('admin_Panel.layout.main')
@section('Main-container')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="page-title">Department Details</h4>
                </div>
                <div class="col-lg-6 text-right">
                    <a class="btn btn-primary btn-rounded" href="{{ route('department.edit', ['department' => $departments->id])}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Profile</a>
                </div>
            </div>
            {{ Breadcrumbs::render() }}
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title text-primary text-center mb-4">{{ $departments->department_name }} - {{ $departments->department_code }}</h3>
                            <p class="card-text"><strong style="font-size: 18px;">Description:</strong> {!! $departments->department_desc !!}</p>
                            <p class="card-text"><strong style="font-size: 18px;">Department Code:</strong> {{ $departments->department_code }}</p>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="counter-box text-center">
                                        <h4 class="counter">{{ $doctorCount }}</h4>
                                        <p class="text-muted">Total Doctors</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="counter-box text-center">
                                        <h4 class="counter">{{ $patientCount }}</h4>
                                        <p class="text-muted">Total Patients</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection