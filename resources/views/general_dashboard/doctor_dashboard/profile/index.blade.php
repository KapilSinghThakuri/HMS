@extends('general_dashboard.doctor_dashboard.layout.main')
@section('Main-container')
<div class="page-wrapper">
    <div class="content">

        <div class="row">
            <div class="col-sm-7 col-6">
                <h4 class="page-title">My Profile</h4>
            </div>
            <div class="col-sm-5 col-6 text-right m-b-30">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-rounded"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Profile </a>
            </div>
        </div>
        @if(session('success_message'))
            <div class="alert alert-success">{{ session('success_message')}}</div>
        @endif
        @if(session('fail_message'))
            <div class="alert alert-success">{{ session('fail_message')}}</div>
        @endif
        <div class="card-box profile-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-view">
                        <div class="profile-img-wrap">
                            <div class="profile-img">
                                <a href="#"><img class="avatar" src="{{ asset( $doctor_basic->profile )}}" alt=""></a>
                            </div>
                        </div>
                        <div class="profile-basic">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="profile-info-left">
                                        <h3 class="user-name m-t-0 mb-0">{{ $doctor_basic->first_name }} {{ $doctor_basic->last_name }}</h3>
                                        <small class="text-muted">{{ $doctor_edu ->specialization }}</small>
                                        <div class="staff-id">License ID : {{ $doctor_exp -> license_no}}</div>
                                        <!-- <div class="staff-msg"><a href="#" class="btn btn-primary">Send Message</a></div> -->
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <ul class="personal-info">
                                        <li>
                                            <span class="title">Phone:</span>
                                            <span class="text"><a href="#">{{ $doctor_basic->phone }}</a></span>
                                        </li>
                                        <li>
                                            <span class="title">Email:</span>
                                            <span class="text"><a href="#">{{ $doctor_basic->email }}</a></span>
                                        </li>
                                        <li>
                                            <span class="title">Birthday:</span>
                                            <span class="text">{{ $doctor_basic -> date_of_birth_AD }}</span>
                                        </li>
                                        <li>
                                            <span class="title">Address:</span>
                                            <span class="text">{{ $doctor_basic->street }}, {{ $doctor_basic->municipality->{'municipality_name[nep]'} }}, {{ $doctor_basic->district->{'district_name[nep]'} }}, {{ $doctor_basic->province->province_name_nep }} Nepal</span>
                                        </li>
                                        <li>
                                            <span class="title">Gender:</span>
                                            <span class="text">{{ $doctor_basic->gender }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-tabs">
            <ul class="nav nav-tabs nav-tabs-bottom">
                <li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-toggle="tab">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="#bottom-tab3" data-toggle="tab">Messages</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane show active" id="about-cont">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <h3 class="card-title">Education Informations</h3>
                                <div class="experience-box">
                                    <ul class="experience-list">
                                        <li>
                                            <div class="experience-user">
                                                <div class="before-circle"></div>
                                            </div>
                                            <div class="experience-content">
                                                <div class="timeline-content">
                                                    <a href="#/" class="name">{{ $doctor_edu->institute_name }} College of Medical Science</a>
                                                    <div>{{ $doctor_edu->medical_degree }}</div>
                                                    <span class="time">{{ $doctor_edu->graduation_year_BS }}BS - {{ $doctor_edu->graduation_year_AD }}AD</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-box mb-0">
                                <h3 class="card-title">Experience</h3>
                                <div class="experience-box">
                                    <ul class="experience-list">
                                        <li>
                                            <div class="experience-user">
                                                <div class="before-circle"></div>
                                            </div>
                                            <div class="experience-content">
                                                <div class="timeline-content">
                                                    <a href="#/" class="name">{!! $doctor_exp -> job_description !!}</a>
                                                    <span class="time">{{ $doctor_exp -> start_date_BS}} - {{ $doctor_exp -> end_date_BS}}</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="experience-user">
                                                <div class="before-circle"></div>
                                            </div>
                                            <div class="experience-content">
                                                <div class="timeline-content">
                                                    <a href="#/" class="name">Consultant Gynecologist</a>
                                                    <span class="time">Jan 2009 - Present (6 years 1 month)</span>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="bottom-tab2">
                    Tab content 2
                </div>
                <div class="tab-pane" id="bottom-tab3">
                    Tab content 3
                </div>
            </div>
        </div>
    </div>
</div>
@endsection