@extends('admin_Panel.layout.main')
@section('Main-container')
    <div class="page-wrapper">
        <div class="content">
        	<div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
                <div class="col-sm-6">
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-sm-6 text-right">
					<a class="btn btn-danger btn-rounded" href="{{ route('admin.dashboard')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                </div>
            </div>

			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-striped custom-table">
							<thead>
								<tr>
									<th>Sno.</th>
									<th>Patient Name</th>
									<th>Age</th>
									<th>Doctor Name</th>
									<th>Department</th>
									<th>Appointment Date</th>
									<th>Appointment Time</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
                                @foreach($appointments as $appointment)
								<tr>
									<td>{{ $loop->index + $appointments->firstItem() }}</td>
									<td><img width="28" height="28" src="assets/img/user.jpg" class="rounded-circle m-r-5" alt=""> {{ $appointment->patient->fullname }}</td>
									<td>{{ $appointment->patient->age }} years</td>
									<td>Dr. {{ $appointment->doctor->first_name }} {{ $appointment->doctor->middle_name }} {{ $appointment->doctor->last_name }}</td>
									<td>{{ $appointment->doctor->departments->department_name }}</td>
									<td>{{ $appointment->schedule->in }}</td>
									<td>{{ $appointment->time_interval }}</td>
									<td>
                                        @if($appointment->status === 'approved')
                                        <span class="custom-badge status-green">Approved</span>
                                        @elseif($appointment->status === 'pending')
                                        <span class="custom-badge status-blue">Pending</span>
                                        @else
                                        <span class="custom-badge status-red">Cancelled</span>
                                        @endif
                                    </td>
								</tr>
                                @endforeach
							</tbody>
						</table>
					</div>
					<div class="d-flex justify-content-center mt-3">
						{{ $appointments->links() }}
					</div>
				</div>
            </div>
        </div>
	</div>
@endsection