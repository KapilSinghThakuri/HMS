@extends('general_dashboard.doctor_dashboard.layout.main')
@section('Main-container')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-4 col-3">
                    <h4 class="page-title">Appointments</h4>
                </div>
                <div class="col-sm-8 col-9 text-right m-b-20">
                    <a href="{{ route('doctor.dashboard')}}" class="btn btn btn-danger btn-rounded float-right"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table">
                            <thead>
                                <tr>
                                    <th>Appointment ID</th>
                                    <th>Patient Name</th>
                                    <th>Age</th>
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
                                    <td>
                                        <a href="{{ route('patient.appointment.view',['appointment'=>$appointment->id ]) }}">
                                            <img width="28" height="28" src="assets/img/user.jpg" class="rounded-circle m-r-5" alt=""> {{ $appointment->patient->fullname }}
                                        </a>
                                    </td>
                                    <td>{{ $appointment->patient->age }} years</td>
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
                                    <td class="text-right">
                                        @if($appointment->status == 'pending')
                                        <div class="dropdown">
                                            <button class="btn btn-outline-primary dropdown-toggle" type="button" id="approvalDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="approvalDropdown">
                                                <form action="{{ route('doctor.appointment-approve',['appointment'=>$appointment->id ])}}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="dropdown-item">Approved</button>
                                                </form>
                                                <form action="{{ route('doctor.appointment-cancel',['appointment'=>$appointment->id ])}}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="dropdown-item">Cancel</button>
                                                </form>
                                            </div>
                                        </div>
                                        @else
                                        <a href="#" data-toggle="modal" data-target="#delete_appointment" style="font-size: 25px; color: red;"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        @endif
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
                        <img src="{{ asset('admin_Assets/img/sent.png')}}" alt="" width="50" height="46">
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