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
            @if(session('success_message'))
                <div class="alert alert-success">{{ session('success_message')}}</div>
            @endif
            @if(session('fail_message'))
                <div class="alert alert-success">{{ session('fail_message')}}</div>
            @endif
			<div class="row doctor-grid">
                @foreach( $doctors as $doctor)
                <div class="col-md-4 col-sm-4  col-lg-3">
                    <div class="profile-widget">
                        <div class="doctor-img">
                            <a class="avatar" href="{{ route('doctor.show', ['doctor' => $doctor->id]) }}"><img alt="" src="{{ asset($doctor->profile) }}"></a>
                        </div>
                        <h4 class="doctor-name text-ellipsis">
                            <a href="{{ route('doctor.show', ['doctor' => $doctor->id]) }}">
                                {{ $doctor->first_name }} {{ $doctor->middle_name }} {{ $doctor->last_name }}
                            </a>
                        </h4>
                        <div class="doc-prof">{{ $doctor->educations[0]->specialization }}</div>
                        <div class="user-country">
                            <i class="fa fa-map-marker"></i>
                            {{ $doctor->municipality->{'municipality_name[nep]'} }}, {{ $doctor->district->{'district_name[nep]'} }}, {{ $doctor->province->province_name_nep }} {{ $doctor->country->english_name }}
                        </div>
                    </div>
                    <div class="profile-action card">
                        <div class="btn-group" role="group" aria-label="Doctor actions">
                            <a href="{{ route('doctor.edit', ['doctor' => $doctor->id]) }}" class="btn btn-outline-primary"><i class="fa fa-pencil m-r-5"></i>Edit</a>
                            <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#delete_doctor"><i class="fa fa-trash-o m-r-5"></i>Delete</button>
                        </div>
                    </div>
                </div>
                @endforeach
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
    <style type="text/css">
        .profile-action.card {
            padding: 10px;
            background-color: #f9f9f9;
            border-top: 1px solid #ccc;
            border-radius: 0 0 5px 5px;
        }

        .profile-action.card .btn-group {
            display: flex;
            justify-content: space-between;
        }

        .profile-action.card .btn {
            flex-grow: 1;
            margin: 0 5px;
        }
    </style>
	<div id="delete_doctor" class="modal fade delete-modal" role="dialog">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body text-center">
					<img src="{{ asset('admin_Assets/img/sent.png')}}" alt="" width="50" height="46">
					<h3>Are you sure want to delete this Doctor?</h3>
					<div class="m-t-20 d-flex justify-content-center"> <a href="#" class="btn btn-white mr-2" data-dismiss="modal">Close</a>
                        <form action="{{ route('doctor.destroy', ['doctor' => $doctor->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection