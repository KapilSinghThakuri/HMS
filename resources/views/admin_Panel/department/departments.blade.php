@extends('admin_Panel.layout.main')
@section('Main-container')

    <div class="page-wrapper">
        <div class="content">
            <div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
                <div class="col-sm-6">
                    {{ Breadcrumbs::render() }}
                </div>
                @can('create department')
                <div class="col-sm-6 text-right">
                    <a href="{{ route('department.create') }}" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Add Department</a>
                </div>
                @endcan
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
                        <table class="table table-hover custom-table mb-0 datatable departmentTable">
                            <thead>
                                <tr>
                                    <th>S No</th>
                                    <th>Department Name</th>
                                    <th>Department Code</th>
                                    <th>Department Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departments as $department)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ route('department.show',['department' => $department->id]) }}">
                                            {{ $department->department_name }}
                                        </a>
                                    </td>
									<td>{{ $department->department_code }}</td>
                                    <td>{!! Str::limit($department->department_desc, 30, '...'  ) !!}</td>
                                    <td>
                                        @can('edit department')
                                        <a href="{{ route('department.edit', ['department' => $department->id]) }}" style="font-size: 20px;" title="Click For Edit"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i></a>
                                        @endcan
                                        @can('delete department')
                                        <a href="#" data-id="{{ $department->id }}" data-toggle="modal" data-target="#delete_department" style="font-size: 25px; color: red;" title="Click For Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        	<div id="delete_department" class="modal fade delete-modal" role="dialog">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body text-center">
					<img src="{{ asset('admin_Assets/img/sent.png')}}" alt="" width="50" height="46">
					<h3>Are you sure want to delete this Department?</h3>
					<div class="m-t-20 d-flex justify-content-center"> <a href="#" class="btn btn-white mr-2" data-dismiss="modal">Close</a>
                        <form action="{{ route('department.destroy', ['department' => $department->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>
                                        @endcan
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
</div>
@endsection
