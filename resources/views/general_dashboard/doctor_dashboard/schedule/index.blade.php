@extends('general_dashboard.doctor_dashboard.layout.main')
@section('Main-container')

<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-4 col-3">
                    <h4 class="page-title">My Schedule</h4>
                </div>
                <div class="col-sm-8 col-9 text-right m-b-20">
                    <a href="{{ route('my-schedule.create')}}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Schedule</a>
                </div>
            </div>
            @if(session('success_message'))
                <div class="alert alert-success">{{ session('success_message')}}</div>
            @endif
            @if(session('fail_message'))
                <div class="alert alert-success">{{ session('fail_message')}}</div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-border table-striped custom-table mb-0">
                            <thead>
                                <tr>
                                    <th>Doctor Name</th>
                                    <th>Department</th>
                                    <th>Available Date</th>
                                    <th>Available Time</th>
                                    <th>Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schedules as $schedule)
                                <tr>
                                    <td><img width="28" height="28" src="{{ asset($doctor->profile) }}" class="rounded-circle m-r-5" alt="">{{ $doctor->first_name }} {{ $doctor->middle_name }} {{ $doctor->last_name }}</td>
                                    <td>{{ $department->department_name }}</td>
                                    <td>{{ $schedule->in }}</td>
                                    <td>{{ $schedule->from }} - {{ $schedule->to }}</td>
                                    <td><span class="custom-badge status-green">Active</span></td>
                                    <td>
                                        <a href="{{ route('my-schedule.edit',['my_schedule'=>$schedule->id] )}}" style="font-size: 20px;"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i></a>
                                        <a href="#" data-toggle="modal" data-id="{{ $schedule->id }}" data-target="#delete_schedule_{{ $schedule->id }}" style="font-size: 25px; color: red;"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <!-- Delete Confirm Modal -->
                                <div id="delete_schedule_{{ $schedule->id }}" class="modal fade delete-modal" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <img src="{{ asset('admin_Assets/img/sent.png') }}" alt="" width="50" height="46">
                                                <h3>Are you sure want to delete this Schedule?</h3>
                                                <div class="m-t-20 d-flex justify-content-center">
                                                    <a href="#" class="btn btn-white mr-2" data-dismiss="modal">Close</a>
                                                    <form action="{{ route('my-schedule.destroy',['my_schedule'=>$schedule->id] )}}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
