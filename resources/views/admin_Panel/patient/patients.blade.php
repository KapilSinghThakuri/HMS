@extends('admin_Panel.layout.main')
@section('Main-container')

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-4 col-3">
                    <h4 class="page-title">Patients</h4>
                </div>
                <div class="col-sm-8 col-9 text-right m-b-20">
                    <a href="{{ route('patient.create')}}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Patient</a>
                </div>
            </div>
			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-border table-striped custom-table datatable mb-0">
							<thead>
								<tr>
									<th>Name</th>
									<th>Age</th>
									<th>Address</th>
									<th>Phone</th>
									<th>Email</th>
									<th class="text-right">Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><img width="28" height="28" src="assets/img/user.jpg" class="rounded-circle m-r-5" alt=""> Jennifer Robinson</td>
									<td>35</td>
									<td>1545 Dorsey Ln NE, Leland, NC, 28451</td>
									<td>(207) 808 8863</td>
									<td>jenniferrobinson@example.com</td>
									<td>
                                        <a href="{{ route('patient.edit') }}" style="font-size: 20px;"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#delete_patient" style="font-size: 25px; color: red;"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    </td>
								</tr>
								<tr>
									<td><img width="28" height="28" src="assets/img/user.jpg" class="rounded-circle m-r-5" alt=""> Terry Baker</td>
									<td>63</td>
									<td>555 Front St #APT 2H, Hempstead, NY, 11550</td>
									<td>(376) 150 6975</td>
									<td>terrybaker@example.com</td>
									<td class="text-right">
										<div class="dropdown dropdown-action">
											<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item" href="{{ route('patient.edit')}}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
												<a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_patient"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
											</div>
										</div>
									</td>
								</tr>
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