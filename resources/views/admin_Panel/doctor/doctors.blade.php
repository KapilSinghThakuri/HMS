@extends('admin_Panel.layout.main')
@section('Main-container')
    @inject('department_helper', 'App\Helpers\DepartmentHelper')
    @inject('speciality_helper', 'App\Helpers\DoctorHelper')

    <div class="page-wrapper">
        <div class="content">

            <div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
                <div class="col-sm-6">
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('doctor.trash') }}" class="btn btn-danger btn-rounded float-right ml-3" title="Trash"><i
                            class="fa fa-trash-o" aria-hidden="true"></i> Trash</a>

                    @can('create doctor')
                        <a href="{{ route('doctor.create') }}" class="btn btn-primary btn-rounded float-right"
                            title="Click for add doctor"><i class="fa fa-plus"></i> Add Doctor</a>
                    @endcan
                </div>
            </div>

            {!! Form::open(['route' => 'doctor.search', 'method' => 'POST']) !!}
            @csrf

            <div class="row" id="searchbar">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::select('department_id', $department_helper->dropdown(), $searchedDepartmentId ?? null, [
                            'class' => 'form-select form-control',
                            'placeholder' => 'Search By Department',
                            'id' => 'department_id',
                        ]) !!}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::select('specialization', $speciality_helper->dropdown(), $searchedSpecialization ?? null, [
                            'class' => 'form-select form-control',
                            'placeholder' => 'Search By Speciality',
                            'id' => 'specialization',
                        ]) !!}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="input-group">
                        {!! Form::text('input_search', $searchedInput ?? null, [
                            'class' => 'form-control',
                            'placeholder' => 'Search by name, email, or license no...',
                            'aria-label' => 'Search',
                            'id' => 'doctorSearchInput',
                        ]) !!}

                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" title="Click For Search">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>

                            <a href="{{ route('doctor.index') }}" class="btn btn-danger ml-1" title="Click For Reset"><i
                                    class="fa fa-undo" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}


            @if (session('success_message'))
                <div class="alert alert-success">{{ session('success_message') }}</div>
            @endif
            @if (session('fail_message'))
                <div class="alert alert-success">{{ session('fail_message') }}</div>
            @endif



            <div class="row doctor-grid">
                @foreach ($doctors as $doctor)
                    <div class="col-md-4 col-sm-4  col-lg-3">
                        <div class="profile-widget">
                            <div class="doctor-img">
                                <a class="avatar" href="{{ route('doctor.show', ['doctor' => $doctor->id]) }}"
                                    title="Click to view profile"><img alt=""
                                        src="{{ asset($doctor->profile) }}"></a>
                            </div>
                            <h4 class="doctor-name text-ellipsis">
                                <a href="{{ route('doctor.show', ['doctor' => $doctor->id]) }}"
                                    title="Click to view profile">
                                    {{ $doctor->first_name }} {{ $doctor->middle_name }} {{ $doctor->last_name }}
                                </a>
                            </h4>
                            {{-- <div class="doc-prof">{{ $doctor->educations[0]->specialization }}</div> --}}
                            <div class="user-country">
                                <i class="fa fa-map-marker"></i>
                                {{ $doctor->municipality->{'municipality_name[nep]'} }},
                                {{ $doctor->district->{'district_name[nep]'} }},
                                {{ $doctor->province->province_name_nep }} {{ $doctor->country->english_name }}
                            </div>
                        </div>
                        <div class="profile-action card">
                            <div class="btn-group" role="group" aria-label="Doctor actions">
                                @can('edit doctor')
                                    <a href="{{ route('doctor.edit', ['doctor' => $doctor->id]) }}"
                                        class="btn btn-outline-primary"><i class="fa fa-pencil m-r-5"></i>Edit</a>
                                @endcan
                                @can('delete doctor')
                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                        data-target="#delete_doctor_{{ $doctor->id }}"><i
                                            class="fa fa-trash-o m-r-5"></i>Delete</button>
                                @endcan
                                <div id="delete_doctor_{{ $doctor->id }}" class="modal fade delete-modal" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body text-center">
                                                <img src="{{ asset('admin_Assets/img/sent.png') }}" alt=""
                                                    width="50" height="46">
                                                <h3>Are you sure want to delete this Doctor?</h3>
                                                <div class="m-t-20 d-flex justify-content-center">
                                                    <a href="#" class="btn btn-white mr-2"
                                                        style="flex-grow: 0; height: 38px; width: 95px;"
                                                        data-dismiss="modal">Cancel</a>
                                                    <form action="{{ route('doctor.destroy', ['doctor' => $doctor->id]) }}"
                                                        method="POST">
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

    </div>
@endsection
