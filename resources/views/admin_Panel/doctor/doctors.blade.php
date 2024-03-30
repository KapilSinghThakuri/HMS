@extends('admin_Panel.layout.main')
@section('Main-container')

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-4 col-3">
                    <h4 class="page-title">Doctors</h4>
                </div>
                <div class="col-sm-8 col-9 text-right m-b-20">
                    <a href="{{ route('doctor.create')}}" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Doctor</a>
                </div>
            </div>
			<div class="row doctor-grid">
                <div class="col-md-4 col-sm-4  col-lg-3">
                    @foreach( $doctors as $doctor)
                    <div class="profile-widget">
                        <div class="doctor-img">
                            <a class="avatar" href="{{ route('doctor.show', ['doctor' => $doctor->id]) }}"><img alt="" src="{{ asset($doctor->profile) }}"></a>
                        </div>
                        <div class="dropdown profile-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="{{ route('doctor.edit', ['doctor' => $doctor->id]) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_doctor"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                            </div>
                        </div>
                        <h4 class="doctor-name text-ellipsis"><a href="profile.html">{{ $doctor->first_name }} {{ $doctor->middle_name }} {{ $doctor->last_name }}</a></h4>
                        <div class="doc-prof">{{ $specialization}}</div>
                        <div class="user-country">
                            <i class="fa fa-map-marker"></i> United States, San Francisco
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
			<div class="row">
                <div class="col-sm-12">
                    <div class="see-all">
                        <a class="see-all-btn" href="javascript:void(0);">Load More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div id="delete_doctor" class="modal fade delete-modal" role="dialog">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body text-center">
					<img src="assets/img/sent.png" alt="" width="50" height="46">
					<h3>Are you sure want to delete this Doctor?</h3>
					<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
						<button type="submit" class="btn btn-danger">Delete</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection