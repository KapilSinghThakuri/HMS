@extends('admin_Panel.layout.main')
@section('Main-container')
<div class="page-wrapper">
    <div class="content">

        <div class="row">
            <div class="col-sm-7 col-6">
                <h4 class="page-title">My Profile</h4>
            </div>
            <div class="col-sm-5 col-6 text-right m-b-30">
                <a href="{{ route('doctor.index') }}" class="btn btn-danger btn-rounded"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back </a>
            </div>
        </div>
        {{ Breadcrumbs::render() }}
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
                                        <small class="text-muted">{{$doctor_edu[0]->specialization}}</small>
                                        <div class="staff-id">License ID : {{$doctor_exp[0]->license_no}}</div>
                                        <div class="staff-msg"><a href="chat.html" class="btn btn-primary">Send Message</a></div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <ul class="personal-info">
                                        <li>
                                            <span class="title">Phone:</span>
                                            <span class="text"><a href="#" class="text-secondary">{{ $doctor_basic->phone }}</a></span>
                                        </li>
                                        <li>
                                            <span class="title">Email:</span>
                                            <span class="text"><a href="#" class="text-secondary">{{ $doctor_basic->email }}</a></span>
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
				<li class="nav-item"><a class="nav-link active" href="#about-cont" data-toggle="tab">Basic Details</a></li>
				<li class="nav-item"><a class="nav-link" href="#bottom-tab2" data-toggle="tab">Academic Details</a></li>
				<li class="nav-item"><a class="nav-link" href="#bottom-tab3" data-toggle="tab">Address Details</a></li>
			</ul>

			<div class="tab-content">
				<div class="tab-pane show active" id="about-cont">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <h3 class="card-title">Basic Informations</h3>
                                <div class="basic-info">
                                    <div class="info-item">
                                        <span class="info-label">Name:</span>
                                        <span class="info-value">Dr. {{ $doctor_basic->first_name }} {{ $doctor_basic->middle_name }} {{ $doctor_basic->last_name }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">Gender:</span>
                                        <span class="info-value">{{ $doctor_basic->gender }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">Date of Birth:</span>
                                        <span class="info-value">{{ $doctor_basic -> date_of_birth_AD }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">Email:</span>
                                        <span class="info-value">{{ $doctor_basic->email }}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">Liscense No:</span>
                                        <span class="info-value">{{$doctor_exp[0]->license_no}}</span>
                                    </div>
                                    <div class="info-item">
                                        <span class="info-label">Specialization:</span>
                                        <span class="info-value">{{$doctor_edu[0]->specialization}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>

                <div class="tab-pane" id="bottom-tab2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-box">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="experience-box">
                                            <h4 class="box-title">Education Informations</h4>
                                            <ul class="experience-list">
                                                @foreach($doctor_edu as $education)
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <a href="#" class="name">{{ $education->institute_name }} College of Medical Science</a>
                                                            <div>{{ $education->medical_degree }}</div>
                                                            <span class="time">{{ $education->graduation_year_BS }}BS - {{ $education->graduation_year_AD }}AD</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="experience-box">
                                            <h4 class="box-title">Experience Informations</h4>
                                            <ul class="experience-list">
                                                @foreach($doctor_exp as $experience)
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <a href="#" class="name">{!! $experience -> job_description !!}</a>
                                                            <span class="time">{{ $experience -> start_date_BS}} - {{ $experience -> end_date_BS}}</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

				<div class="tab-pane" id="bottom-tab3">
					<div class="card">
                        <div class="card-body">
                            <h5 class="card-title" style="margin-bottom: 12px;">Address Details</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="address-section">
                                        <div class="address-title">Permanent Address</div>
                                        <div class="address-info">
                                            <p>Country : {{ $doctor_basic->country->english_name }}</p>
                                            <p>Province : {{ $doctor_basic->province->province_name_nep }}</p>
                                            <p>District : {{ $doctor_basic->district->{'district_name[nep]'} }}</p>
                                            <p>Municipality : {{ $doctor_basic->municipality->{'municipality_name[nep]'} }}</p>
                                            <p>Street : {{ $doctor_basic->street }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="address-section">
                                        <div class="address-title">Temporary Address</div>
                                        <div class="address-info">
                                            <p>Country : {{ $doctor_basic->country->english_name }}</p>
                                            <p>Province : {{ $temp_province->province_name_nep }} </p>
                                            <p>District : {{ $temp_district->{'district_name[nep]'} }}</p>
                                            <p>Municipality : {{ $temp_municipality->{'municipality_name[nep]'} }}</p>
                                            <p>Street : {{ $doctor_basic->temp_street }}</p>
                                        </div>
                                    </div>
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