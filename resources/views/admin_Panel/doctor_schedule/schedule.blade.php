@extends('admin_Panel.layout.main')
@section('Main-container')

<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-4 col-3">
                    <h4 class="page-title">Doctor Schedules</h4>
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
                                    <th>Sno.</th>
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
                                    @php
                                        $timeIntervals = $schedule->time_intervals;
                                    @endphp
                                    @foreach($timeIntervals as $interval)
                                        <tr>
                                            <td>{{ $loop->index + $schedules->firstItem() }}</td>
                                            <td><img width="28" height="28" src="{{ asset($schedule->doctor->profile )}}" class="rounded-circle m-r-5" alt="">Dr. {{ $schedule->doctor->first_name }} {{ $schedule->doctor->middle_name }} {{ $schedule->doctor->last_name }}</td>
                                            <td>{{ $schedule->doctor->departments->department_name }}</td>
                                            <td>{{ $schedule->in }}</td>
                                            <td>{{ $interval }}</td>
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
                                                <a href="{{ route('schedule.edit',['schedule' => $schedule->id ])}}" style="font-size: 20px;" title="Click for edit"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i></a>
                                                <a href="#" data-toggle="modal" data-target="#delete_schedule_{{ $schedule->id }}" style="font-size: 25px; color: red;" title="Click for delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                <!-- Delete Modal -->
                                                <div id="delete_schedule_{{ $schedule->id }}" class="modal fade delete-modal" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-body text-center">
                                                                <img src="{{ asset('admin_Assets/img/sent.png')}}" alt="" width="50" height="46">
                                                                <h3>Are you sure want to delete this Schedule?</h3>
                                                                <div class="m-t-20 d-flex justify-content-center">
                                                                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                                                                    <form action="{{ route('schedule.destroy', ['schedule'=>$schedule->id]) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger ml-2">Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
						</table>
					</div>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $schedules->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection