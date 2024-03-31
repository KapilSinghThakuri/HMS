@extends('admin_Panel.layout.main')
@section('Main-container')

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-5 col-5">
                    <h4 class="page-title">Departments</h4>
                </div>
                <div class="col-sm-7 col-7 text-right m-b-30">
                    <a href="{{ route('department.create') }}" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Add Department</a>
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
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                                <tr>
                                    <th>S no.</th>
                                    <th>Department Name</th>
                                    <th>Department Code</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departments as $department)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $department->department_name }}</td>
									<td>{{ $department->department_code }}</td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{ route('department.edit', ['department' => $department->id]) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>

                                                <a class="dropdown-item" href="#" data-id="{{ $department->id }}" data-toggle="modal" data-target="#delete_department"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
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
	<div id="delete_department" class="modal fade delete-modal" role="dialog">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-body text-center">
					<img src="{{ asset('admin_Assets/img/sent.png')}}" alt="" width="50" height="46">
					<h3>Are you sure want to delete this Department?</h3>
					<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                        <form action="{{ route('department.destroy', ['department' => $department->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mt-2">Delete</button>
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
