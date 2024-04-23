<!-- doctor-trash.blade.php -->
@extends('admin_Panel.layout.main')
@section('Main-container')

    <div class="page-wrapper">
        <div class="content">
            <div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
                <div class="col-sm-6">
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('doctor.index')}}" class="btn btn-danger btn-rounded"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-hover custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>Sno.</th>
                                    <th>Doctor Name</th>
                                    <th>Email</th>
                                    <th>Department</th>
                                    <th>Specialization</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($softDeletedDoctors->isEmpty())
                                    <tr class="mt-3">
                                        <td colspan="6">
                                            <div class="alert alert-info">
                                                <strong>No trash found!</strong> You haven't deleted any doctors yet.
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    @foreach($softDeletedDoctors as $doctor)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img width="28" height="28" src="{{ asset($doctor->profile)}}" class="rounded-circle m-r-5" alt="">{{ $doctor->first_name }} {{ $doctor->middle_name }} {{ $doctor->last_name }}</td>
                                        <td>{{ $doctor->user->email }}</td>
                                        <td>{{ $doctor->departments->department_name }}</td>
                                        <td>{{ $doctor->educations[0]->specialization }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('doctor.restore',['doctor'=>$doctor->id])}}" class="text-primary mr-3" style="font-size: 20px;" title="Restore"> <i class="fa fa-undo" aria-hidden="true"></i> </a>
                                            <a href="#" data-id="{{ $doctor->id }}" data-toggle="modal" data-target="#delete_doctor-{{ $doctor->id }}" style="font-size: 20px; color: red;" title="Permanent Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </td>
                                        <div id="delete_doctor-{{ $doctor->id }}" class="modal fade delete-modal" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body text-center">
                                                        <img src="{{ asset('admin_Assets/img/sent.png')}}" alt="" width="50" height="46">
                                                        <h3>Are you sure want to permanent delete this Doctor?</h3>
                                                        <div class="m-t-20 d-flex justify-content-center"> <a href="#" class="btn btn-white mr-2" data-dismiss="modal">Cancel</a>
                                                            <form action="{{ route('doctor.permanentDelete',['doctor'=>$doctor->id])}}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        @if(!$softDeletedDoctors->isEmpty())
                        <div class="empty_all text-center mt-3">
                            <a href="{{ route('trash.empty') }}" class="btn btn-lg btn-danger rounded"><i class="fa fa-trash-o" aria-hidden="true"></i> Empty</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
