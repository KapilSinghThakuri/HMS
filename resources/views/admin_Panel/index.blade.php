@extends('admin_Panel.layout.main')
@section('Main-container')

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="dash-widget">
						<span class="dash-widget-bg1"><i class="fa fa-stethoscope" aria-hidden="true"></i></span>
						<div class="dash-widget-info text-right">
							<h3>{{ $doctors->count() }}</h3>
							<span class="widget-title1">Doctors <i class="fa fa-check" aria-hidden="true"></i></span>
						</div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="dash-widget">
                        <span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
                        <div class="dash-widget-info text-right">
                            <h3>{{ $patients->count() }}</h3>
                            <span class="widget-title2">Patients <i class="fa fa-check" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="dash-widget">
                        <span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
                        <div class="dash-widget-info text-right">
                            <h3>{{ $appointments->count() }}</h3>
                            <span class="widget-title3">Appointment <i class="fa fa-check" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="dash-widget">
                        <span class="dash-widget-bg4"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
                        <div class="dash-widget-info text-right">
                            <h3>{{ $departments->count() }}</h3>
                            <span class="widget-title4">Department <i class="fa fa-check" aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
            </div>
			<div class="row">
				<div class="col-12 col-md-6 col-lg-8 col-xl-8">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title d-inline-block">Recent Patient Admissions</h4>
						@if(count($patients) >= 5 )
							<a href="{{ route('patient.index')}}" class="btn btn-primary float-right">View all</a>
						@endif
						</div>
						<div class="card-block">
							<div class="table-responsive">
								<table class="table mb-0 table-striped new-patient-table" style="border-spacing: 0;">
									<thead>
										<tr>
											<th>Full Name</th>
											<th>Age</th>
											<th>Permanent Address</th>
											<th>Phone</th>
											<th>Disease</th>
										</tr>
									</thead>
									<tbody>
										@foreach($patients->take(6) as $patient)
										<tr>
											<td>
												<img width="28" height="28" class="rounded-circle" src="assets/img/user.jpg" alt="">
												<h2>{{$patient->fullname}}</h2>
											</td>
											<td>{{$patient->age}} years</td>
											<td>{{$patient->permanent_address}}</td>
											<td>{{$patient->phone}}</td>
											<td>{{ $patient->appointment->reason }}</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

                <div class="col-12 col-md-6 col-lg-4 col-xl-4">
				    <div class="card member-panel">
				        <div class="card-header bg-white">
				            <h4 class="card-title mb-0">Our Newest Doctors</h4>
				        </div>
				        <div class="card-body">
				            <ul class="contact-list">
				                @foreach($doctors->take(5) as $doctor)
				                <li>
				                    <div class="contact-cont">
				                        <div class="float-left user-img m-r-10">
				                            <a href="{{ route('doctor.show', ['doctor' => $doctor->id]) }}" title="Click to view profile">
				                                <img src="{{ asset($doctor->profile)}}" alt="" width="34" height="34" class="rounded-circle">
				                                <span class="status online"></span>
				                            </a>
				                        </div>
				                        <div class="contact-info">
				                            <a href="{{ route('doctor.show', ['doctor' => $doctor->id]) }}" title="Click to view profile">
					                            <span class="contact-name text-ellipsis">{{ $doctor->first_name }} {{ $doctor->middle_name }} {{ $doctor->last_name }}</span>
				                            </a>
				                            <span class="contact-date">{{ $doctor->educations[0]->medical_degree }}</span>
				                        </div>
				                    </div>
				                </li>
				                @endforeach
				            </ul>
				        </div>
				        @if(count($doctors) >= 5)
				        <div class="card-footer text-center bg-white view_all_doctor">
				            <a href="{{ route('doctor.index')}}" class="text-muted">View all Doctors</a>
				        </div>
				        @endif
				    </div>
				</div>
			</div>
			<!-- <div class="row">
				<div class="col-12 col-md-6 col-lg-4 col-xl-4">
					<div class="hospital-barchart">
						<h4 class="card-title d-inline-block">Departments</h4>
					</div>
					<div class="bar-chart">
						<div class="legend">
							<div class="item">
								<h4>Level1</h4>
							</div>

							<div class="item">
								<h4>Level2</h4>
							</div>
							<div class="item text-right">
								<h4>Level3</h4>
							</div>
							<div class="item text-right">
								<h4>Level4</h4>
							</div>
						</div>
						<div class="chart clearfix">
							<div class="item">
								<div class="bar">
									<span class="percent">16%</span>
									<div class="item-progress" data-percent="16">
										<span class="title">OPD Patient</span>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="bar">
									<span class="percent">71%</span>
									<div class="item-progress" data-percent="71">
										<span class="title">New Patient</span>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="bar">
									<span class="percent">82%</span>
									<div class="item-progress" data-percent="82">
										<span class="title">Laboratory Test</span>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="bar">
									<span class="percent">67%</span>
									<div class="item-progress" data-percent="67">
										<span class="title">Treatment</span>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="bar">
									<span class="percent">30%</span>
									<div class="item-progress" data-percent="30">
										<span class="title">Discharge</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> -->
        </div>
    </div>
</div>
@endsection