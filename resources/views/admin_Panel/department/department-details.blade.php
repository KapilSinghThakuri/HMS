@extends('admin_Panel.layout.main')
@section('Main-container')
    <div class="page-wrapper">
        <div class="content">
            <div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
                <div class="col-sm-6">
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-sm-6 text-right">
                    <a class="btn btn-primary btn-rounded" href="{{ route('department.edit', ['department' => $departments->id])}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Department</a>
                </div>
            </div>

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