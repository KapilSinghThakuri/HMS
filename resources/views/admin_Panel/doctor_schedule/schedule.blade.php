@extends('admin_Panel.layout.main')
@section('Main-container')

<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-4 col-3">
                    <h4 class="page-title">Schedule</h4>
                </div>
                <div class="col-sm-8 col-9 text-right m-b-20">
                    <a href="{{ route('schedule.create')}}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Schedule</a>
                </div>
            </div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-border table-striped custom-table mb-0">
							<thead>
								<tr>
									<th>Doctor Name</th>
									<th>Department</th>
									<th>Available Days</th>
									<th>Available Time</th>
									<th>Status</th>
									<th class="text-right">Action</th>
								</tr>
							</thead>
							<tbody>
                                @foreach($schedules as $schedule)
								<tr>
									<td><img width="28" height="28" src="{{ asset($schedule->doctor->profile )}}" class="rounded-circle m-r-5" alt="">Dr. {{ $schedule->doctor->first_name }} {{ $schedule->doctor->middle_name }} {{ $schedule->doctor->last_name }}</td>
									<td>{{ $schedule->doctor->departments->department_name }}</td>
									<td>{{ $schedule->in }}</td>
									<td>{{ $schedule->from }} - {{ $schedule->to }}</td>
									<td>
                                        @if($schedule->appointment)
                                            @if($schedule->appointment->status === 'approved')
                                            <span class="custom-badge status-green">Approved</span>
                                            @elseif($schedule->appointment->status === 'pending')
                                            <span class="custom-badge status-purple">Pending</span>
                                            @else
                                            <span class="custom-badge status-red">Cancelled</span>
                                            @endif
                                        @else
                                        <span class="custom-badge status-grey">Opened</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="#" style="font-size: 20px;"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#delete_schedule" style="font-size: 25px; color: red;"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </td>
								</tr>
                                @endforeach
							</tbody>
						</table>
					</div>
                </div>
            </div>
        </div>
    </div>
	<div id="delete_schedule" class="modal fade delete-modal" role="dialog">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body text-center">
					<img src="{{ asset('admin_Assets/img/sent.png')}}" alt="" width="50" height="46">
					<h3>Are you sure want to delete this Schedule?</h3>
					<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
						<button type="submit" class="btn btn-danger">Delete</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection