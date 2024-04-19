@extends('general_dashboard.doctor_dashboard.layout.main')
@section('Main-container')

    <div class="page-wrapper">
        <div class="content">
            {{ Breadcrumbs::render() }}
            <div class="row">
                <div class="col-sm-4 col-3">
                    <h4 class="page-title">All Patients Details</h4>
                </div>
                <div class="col-sm-8 col-9 text-right m-b-20">
                    <a href="{{ route('doctor.dashboard')}}" class="btn btn btn-danger btn-rounded float-right"><i class="fa fa-chevron-left" aria-hidden="true"></i>  Back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-border table-striped custom-table datatable mb-0">
                            <thead>
                                <tr>
                                    <th>Sno.</th>
                                    <th>Name</th>
                                    <th>Age</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $appointment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img width="28" height="28" src="assets/img/user.jpg" class="rounded-circle m-r-5" alt=""> {{ $appointment->patient->fullname }}</td>
                                    <td>{{ $appointment->patient->age }} years</td>
                                    <td>{{ $appointment->patient->permanent_address }}</td>
                                    <td>{{ $appointment->patient->phone }}</td>
                                    <td>{{ $appointment->patient->email }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="delete_patient" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="assets/img/sent.png" alt="" width="50" height="46">
                    <h3>Are you sure want to delete this Patient?</h3>
                    <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection