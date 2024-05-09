@extends('admin_Panel.layout.main')
@section('Main-container')
@inject('doctor_helper','App\Helpers\DoctorHelper')

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="dash-widget">
						<span class="dash-widget-bg1">
							<a href="{{ route('doctor.index')}}" style="color: white;">
								<i class="fa fa-user-md" aria-hidden="true"></i>
							</a>
						</span>
						<div class="dash-widget-info text-right">
							<h3>{{ $doctors->count() }}</h3>

							<span class="widget-title1">
								<a href="{{ route('doctor.index')}}" style="color: white;">
									Doctors<i class="fa fa-check" aria-hidden="true"></i>
								</a>
							</span>
						</div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="dash-widget">
                        <span class="dash-widget-bg2">
                        	<a href="{{ route('patient.index')}}" style="color: white;">
	                        	<i class="fa fa-heartbeat" aria-hidden="true"></i>
	                        </a>
	                    </span>
                        <div class="dash-widget-info text-right">
                            <h3>{{ $patients->count() }}</h3>
                            <span class="widget-title2">
                            	<a href="{{ route('patient.index')}}" style="color: white;">
	                            	Patients <i class="fa fa-check" aria-hidden="true"></i>
	                            </a>
                           	</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="dash-widget">
                        <span class="dash-widget-bg3">
                        	<a href="{{ route('appointment.index')}}" style="color: white;">
                        		<i class="fa fa-stethoscope" aria-hidden="true"></i>
	                        </a>
                        </span>
                        <div class="dash-widget-info text-right">
                            <h3>{{ $appointments->count() }}</h3>
                            <span class="widget-title3">
                            	<a href="{{ route('appointment.index')}}" style="color: white;">
	                            	Appointment <i class="fa fa-check" aria-hidden="true"></i>
                            	</a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                    <div class="dash-widget">
                        <span class="dash-widget-bg4">
                        	<a href="{{ route('department.index')}}" style="color: white;">
                        		<i class="fa fa-building" aria-hidden="true"></i>
	                        </a>
                        </span>
                        <div class="dash-widget-info text-right">
                            <h3>{{ $departments->count() }}</h3>
                            <span class="widget-title4">
                            	<a href="{{ route('department.index')}}" style="color: white;">
	                            	Department <i class="fa fa-check" aria-hidden="true"></i>
	                            </a>
                            </span>
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

			<!-- Bar Chart-->
			<div class="row mb-5">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="card-title text-center">
								Bar-Chart
							</div>
							<form method="POST" action="{{ route('doctor.chart')}}">
								@csrf
								<div class="form-group d-flex justify-content-between align-items-center">
							        <select name="doctor_id" class="form-control flex-grow-1">
							            <option disabled>Select doctor to view doctor's bar chart</option>
							            @foreach($doctor_helper->doctorDropdown() as $doctor)
							                <option value="{{ $doctor->id }}" {{ session('doctorId') == $doctor->id ? 'selected' : '' }}>{{ $doctor->first_name }} {{ $doctor->middle_name }} {{ $doctor->last_name }}</option>
							            @endforeach
							        </select>

							        <button type="submit" class="btn btn-outline-primary btn-lg ml-3">Submit</button>
							    </div>
							</form>
						</div>
						<div class="card-body">
							<canvas id="barChart"></canvas>
						</div>
					</div>
				</div>
			</div>
			<!-- Event Calender -->
			<div class="row">
				<div class="col-md-12">
					<div class="card p-2">
						<!-- <div class="alert alert-success">
							<h2>Doctor Schedules</h2>
					        <p>This calendar shows the schedule for all doctors. Click on an event for more details.</p>
						</div> -->

						<div id="fullcalendar"></div>
					</div>
				</div>
			</div>
			@php
				$labels = session('labels');
				$patientCount = session('patientCounts');
			@endphp

			@push('scripts')
			<!-- Bar-Chart -->
			<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
			<script type="text/javascript">
				const ctx = document.getElementById('barChart');

				new Chart(ctx, {
				    type: 'bar',
				    data: {
				      labels: @json($labels),
				      datasets: [{
				        label: 'Total Patients Count',
				        data: @json($patientCount),
				        backgroundColor: [
					      'rgba(255, 99, 132, 0.2)',
						  'rgba(255, 159, 64, 0.2)',
						  'rgba(255, 205, 86, 0.2)',
						  'rgba(75, 192, 192, 0.2)',
						  'rgba(54, 162, 235, 0.2)',
						  'rgba(153, 102, 255, 0.2)',
						  'rgba(201, 203, 207, 0.2)',
						  'rgba(255, 87, 34, 0.2)',
						  'rgba(139, 195, 74, 0.2)',
						  'rgba(244, 67, 54, 0.2)',
						  'rgba(33, 150, 243, 0.2)',
						  'rgba(255, 235, 59, 0.2)'
					    ],
					    borderColor: [
					      'rgb(255, 99, 132)',
					      'rgb(255, 159, 64)',
					      'rgb(255, 205, 86)',
					      'rgb(75, 192, 192)',
					      'rgb(54, 162, 235)',
					      'rgb(153, 102, 255)',
					      'rgb(201, 203, 207)'
					    ],
				        borderWidth: 1,
				      }]
				    },
				    options: {
				      scales: {
				        y: {
				         	beginAtZero: true,
				         	max: 10,
				         	ticks: {
                                stepSize: 2,
                            },
				        }
				      }
				    }
				});
			</script>
			<!-- Event Calender -->
			<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.11/index.global.min.js" integrity="sha512-WPqMaM2rVif8hal2KZZSvINefPKQa8et3Q9GOK02jzNL51nt48n+d3RYeBCfU/pfYpb62BeeDf/kybRY4SJyyw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.11/index.min.js" integrity="sha512-xCMh+IX6X2jqIgak2DBvsP6DNPne/t52lMbAUJSjr3+trFn14zlaryZlBcXbHKw8SbrpS0n3zlqSVmZPITRDSQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
			<script type="text/javascript">
				$(document).ready(function () {
					$.ajaxSetup({
					    headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    }
					});
					var fullcalendar = $('#fullcalendar')[0];
					var events = [];
				    var calendar = new FullCalendar.Calendar(fullcalendar, {
				        initialView: 'dayGridMonth',
				        locale: 'ne',
				    	height: 600,
				        eventBackgroundColor: '#00ce7c',
				        editable: true,

				        headerToolbar:
				        {
			            	left: 'today prev,next',
				            center: 'title',
				            right: 'dayGridMonth timeGridWeek timeGridDay',
				        },
				        events: '/Healwave/admin/event',
				    });
				    calendar.render();
				});
			</script>
			@endpush
        </div>
    </div>
</div>
@endsection