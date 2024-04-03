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
            <div class="row">
                <div class="col-offset-2 col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title text-primary text-center border-bottom mb-2">{{ $departments->department_name }} - {{ $departments->department_code }}</h3>
                            <p class="card-text"><strong>Description:</strong> {!! $departments->department_desc !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection