@extends('admin_Panel.layout.main')
@section('Main-container')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-4 col-3">
                    <h4 class="page-title">Appointments</h4>
                </div>
                <div class="col-sm-8 col-9 text-right m-b-20">
                    <a href="#" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Appointment</a>
                </div>
            </div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-striped custom-table">
							<thead>
								<tr>
									<th>App. ID</th>
									<th>Patient Name</th>
									<th>Age</th>
									<th>Doctor Name</th>
									<th>Department</th>
									<th>Appointment Date</th>
									<th>Appointment Time</th>
									<th>Status</th>
									<th class="text-right">Action</th>
								</tr>
							</thead>
							<tbody>
                                @foreach($appointments as $appointment)
								<tr>
									<td>{{ $appointment->id }}</td>
									<td><img width="28" height="28" src="assets/img/user.jpg" class="rounded-circle m-r-5" alt=""> {{ $appointment->patient->fullname }}</td>
									<td>{{ $appointment->patient->age }} years</td>
									<td>Dr. {{ $appointment->doctor->first_name }} {{ $appointment->doctor->middle_name }} {{ $appointment->doctor->last_name }}</td>
									<td>{{ $appointment->doctor->departments->department_name }}</td>
									<td>{{ $appointment->schedule->in }}</td>
									<td>{{ $appointment->schedule->from }} - {{ $appointment->schedule->to }}</td>
									<td>
                                        @if($appointment->status === 'approved')
                                        <span class="custom-badge status-green">Approved</span>
                                        @elseif($appointment->status === 'pending')
                                        <span class="custom-badge status-blue">Pending</span>
                                        @else
                                        <span class="custom-badge status-red">Cancelled</span>
                                        @endif
                                    </td>
									<td>
                                        <a href="{{ route('appointment.edit') }}" style="font-size: 20px;"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#delete_appointment" style="font-size: 25px; color: red;"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </td>
								</tr>
                                @endforeach
							</tbody>
						</table>
					</div>
				</div>
            </div>
        </div>
		<div id="delete_appointment" class="modal fade delete-modal" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
						<img src="assets/img/sent.png" alt="" width="50" height="46">
						<h3>Are you sure want to delete this Appointment?</h3>
						<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
							<button type="submit" class="btn btn-danger">Delete</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection