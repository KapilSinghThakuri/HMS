@extends('admin_Panel.layout.main')
@section('Main-container')
<div class="page-wrapper">
    <div class="content">
        <div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
            <div class="col-sm-6">
                {{ Breadcrumbs::render() }}
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('role.create')}}" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Add Role</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped" id="roles">
                    <thead>
                        <tr>
                            <th>Sno.</th>
                            <th>Role Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <a href="{{ route('role.edit',['role'=> $role->id])}}" class="btn btn-outline-primary btn-lg"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                                <a href="#" data-toggle="modal" data-target="#delete_role" class="btn btn-outline-danger btn-lg ml-2 delete-btn"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- <div class="row">
            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-3">
                <a href="{{ route('role.create')}}" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Add Roles</a>
                <div class="roles-menu">
                    <ul>
                        @foreach($roles as $role)
                        <li class="active">
                            <a href="javascript:void(0);">{{ $role->name }}</a>
							<span class="role-action">
								<a href="{{ route('role.edit',['role'=> $role->id])}}">
									<span class="action-circle btn-primary large">
										<i class="material-icons">edit</i>
									</span>
								</a>
								<a href="#" data-toggle="modal" data-target="#delete_role">
									<span class="action-circle btn-danger large delete-btn">
										<i class="material-icons">delete</i>
									</span>
								</a>
							</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-sm-8 col-md-8 col-lg-8 col-xl-9">
                <h6 class="card-title m-b-20">Module Access</h6>
                <div class="m-b-30">
                    <ul class="list-group">
                        <li class="list-group-item">
                            Department
                            <div class="material-switch float-right">
                                <input id="staff_module" type="checkbox">
                                <label for="staff_module" class="badge-success"></label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            Doctor
                            <div class="material-switch float-right">
                                <input id="staff_module" type="checkbox">
                                <label for="staff_module" class="badge-success"></label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            Schedule
                            <div class="material-switch float-right">
                                <input id="staff_module" type="checkbox">
                                <label for="staff_module" class="badge-success"></label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            Patient
                            <div class="material-switch float-right">
                                <input id="staff_module" type="checkbox">
                                <label for="staff_module" class="badge-success"></label>
                            </div>
                        </li>
                        <li class="list-group-item">
                            Appointment
                            <div class="material-switch float-right">
                                <input id="staff_module" type="checkbox">
                                <label for="staff_module" class="badge-success"></label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped custom-table">
                <thead>
                    <tr>
                        <th>Module Permission</th>
                        <th class="text-center">Read</th>
                        <th class="text-center">Write</th>
                        <th class="text-center">Create</th>
                        <th class="text-center">Delete</th>
                        <th class="text-center">Import</th>
                        <th class="text-center">Export</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Employee</td>
                        <td class="text-center">
                            <input type="checkbox" checked="">
                        </td>
                        <td class="text-center">
                            <input type="checkbox" checked="">
                        </td>
                        <td class="text-center">
                            <input type="checkbox" checked="">
                        </td>
                        <td class="text-center">
                            <input type="checkbox" checked="">
                        </td>
                        <td class="text-center">
                            <input type="checkbox" checked="">
                        </td>
                        <td class="text-center">
                            <input type="checkbox" checked="">
                        </td>
                    </tr>
                    <tr>
                        <td>Holidays</td>
                        <td class="text-center">
                            <input type="checkbox" checked="">
                        </td>
                        <td class="text-center">
                            <input type="checkbox" checked="">
                        </td>
                        <td class="text-center">
                            <input type="checkbox" checked="">
                        </td>
                        <td class="text-center">
                            <input type="checkbox" checked="">
                        </td>
                        <td class="text-center">
                            <input type="checkbox" checked="">
                        </td>
                        <td class="text-center">
                            <input type="checkbox" checked="">
                        </td>
                    </tr>
                    <tr>
                        <td>Leave Request</td>
                        <td class="text-center">
                            <input type="checkbox" checked="">
                        </td>
                        <td class="text-center">
                            <input type="checkbox" checked="">
                        </td>
                        <td class="text-center">
                            <input type="checkbox" checked="">
                        </td>
                        <td class="text-center">
                            <input type="checkbox" checked="">
                        </td>
                        <td class="text-center">
                            <input type="checkbox" checked="">
                        </td>
                        <td class="text-center">
                            <input type="checkbox" checked="">
                        </td>
                    </tr>
                    <tr>
                        <td>Events</td>
                        <td class="text-center">
                            <input type="checkbox" checked="">
                        </td>
                        <td class="text-center">
                            <input type="checkbox" checked="">
                        </td>
                        <td class="text-center">
                            <input type="checkbox" checked="">
                        </td>
                        <td class="text-center">
                            <input type="checkbox" checked="">
                        </td>
                        <td class="text-center">
                            <input type="checkbox" checked="">
                        </td>
                        <td class="text-center">
                            <input type="checkbox" checked="">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div> -->
    </div>
</div>
<div id="delete_role" class="modal fade delete-modal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="{{ asset('admin_Assets/img/sent.png')}}" alt="" width="50" height="46">
                <h3>Are you sure want to delete this Role?</h3>
                <div class="m-t-20 d-flex justify-content-center">
                    <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                    <form method="POST" action="{{ route('role.destroy',['role'=>$role->id])}}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger ml-2">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection